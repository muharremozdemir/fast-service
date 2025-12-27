<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AvailabilityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAvailabilityController extends Controller
{
    protected $availabilityService;

    public function __construct(AvailabilityService $availabilityService)
    {
        $this->availabilityService = $availabilityService;
    }

    /**
     * Kullanıcının müsaitlik durumunu güncelle
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(Request $request)
    {
        $request->validate([
            'status' => 'required|string|in:available,busy,offline,on_break',
        ]);

        $user = $request->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated'
            ], 401);
        }

        try {
            $success = $this->availabilityService->updateAvailabilityStatus($user, $request->status);

            if ($success) {
                $user->refresh();

                return response()->json([
                    'success' => true,
                    'message' => 'Müsaitlik durumu başarıyla güncellendi.',
                    'data' => [
                        'user_id' => $user->id,
                        'availability_status' => $user->availability_status,
                    ]
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Müsaitlik durumu güncellenirken bir hata oluştu.'
                ], 500);
            }
        } catch (\InvalidArgumentException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Kullanıcının mevcut müsaitlik durumunu al
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStatus(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated'
            ], 401);
        }

        $status = $this->availabilityService->getAvailabilityStatus($user);

        return response()->json([
            'success' => true,
            'data' => [
                'user_id' => $user->id,
                'availability_status' => $status,
            ]
        ]);
    }

    /**
     * Tüm geçerli müsaitlik durumlarını listele
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAvailableStatuses()
    {
        $statuses = $this->availabilityService->getAvailableStatuses();

        return response()->json([
            'success' => true,
            'data' => $statuses
        ]);
    }
}

