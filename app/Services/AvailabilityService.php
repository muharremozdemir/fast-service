<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class AvailabilityService
{
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

