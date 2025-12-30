<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class AvailabilityService
{
    protected $oneSignalService;

    public function __construct(OneSignalService $oneSignalService)
    {
        $this->oneSignalService = $oneSignalService;
    }

    /**
     * Kullanıcının müsaitlik durumunu güncelle
     *
     * @param User $user
     * @param string $status
     * @return bool
     */
    public function updateAvailabilityStatus(User $user, string $status): bool
    {
        $validStatuses = ['available', 'busy', 'offline', 'on_break'];

        if (!in_array($status, $validStatuses)) {
            throw new \InvalidArgumentException('Geçersiz müsaitlik durumu: ' . $status);
        }

        try {
            $user->availability_status = $status;
            $user->save();

            Log::info('Kullanıcı müsaitlik durumu güncellendi', [
                'user_id' => $user->id,
                'status' => $status,
            ]);

            // OneSignal bildirimi gönder
            $this->sendAvailabilityNotification($user, $status);

            return true;
        } catch (\Exception $e) {
            Log::error('Kullanıcı müsaitlik durumu güncellenirken hata oluştu', [
                'user_id' => $user->id,
                'status' => $status,
                'error' => $e->getMessage(),
            ]);

            return false;
        }
    }

    /**
     * Müsaitlik durumu değişikliği için OneSignal bildirimi gönder
     *
     * @param User $user
     * @param string $status
     * @return void
     */
    protected function sendAvailabilityNotification(User $user, string $status): void
    {
        // Kullanıcının player_id (OneSignal player ID) yoksa bildirim gönderme
        if (!$user->player_id) {
            Log::info('Kullanıcının player_id yok, bildirim gönderilmedi', [
                'user_id' => $user->id,
            ]);
            return;
        }

        $statusMessages = [
            'available' => 'Müsait durumuna geçtiniz',
            'busy' => 'Meşgul durumuna geçtiniz',
            'offline' => 'Çevrimdışı durumuna geçtiniz',
            'on_break' => 'Molada durumuna geçtiniz',
        ];

        $title = 'Durum Güncellendi';
        $message = $statusMessages[$status] ?? 'Durumunuz güncellendi';

        $result = $this->oneSignalService->sendToUser(
            $title,
            $message,
            $user->player_id,
            [
                'id' => $user->id,
                'type' => 'availability_status_change',
                'status' => $status,
            ],
            'tr'
        );

        if ($result === false || (isset($result['error']) && $result['error'])) {
            Log::warning('OneSignal bildirimi gönderilirken hata oluştu', [
                'user_id' => $user->id,
                'error' => $result['message'] ?? 'Bilinmeyen hata',
            ]);
        } else {
            Log::info('OneSignal bildirimi başarıyla gönderildi', [
                'user_id' => $user->id,
                'status' => $status,
            ]);
        }
    }

    /**
     * Kullanıcının mevcut müsaitlik durumunu al
     *
     * @param User $user
     * @return string|null
     */
    public function getAvailabilityStatus(User $user): ?string
    {
        return $user->availability_status;
    }

    /**
     * Tüm geçerli müsaitlik durumlarını döndür
     *
     * @return array
     */
    public function getAvailableStatuses(): array
    {
        return [
            'available' => 'Müsait',
            'busy' => 'Meşgul',
            'offline' => 'Çevrimdışı',
            'on_break' => 'Molada',
        ];
    }
}

