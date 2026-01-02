<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('user', function (Request $request) {
    $user = $request->user();

    if (!$user) {
        return response()->json(['message' => 'Unauthenticated'], 401);
    }

    // Company_id context'ini ayarla (Spatie Permission teams için)
    setPermissionsTeamId($user->company_id);

    // Kullanıcının rolleri ve yetkilerini çek
    $roles = $user->roles()->get()->map(function ($role) {
        // Role atanmış yetkileri çek
        $rolePermissions = $role->permissions()->get()->map(function ($permission) {
            return [
                'id' => $permission->id,
                'name' => $permission->name,
                'label' => $permission->label,
                'group' => $permission->group,
            ];
        });

        return [
            'id' => $role->id,
            'name' => $role->name,
            'guard_name' => $role->guard_name,
            'permissions' => $rolePermissions,
        ];
    });

    $permissions = $user->getAllPermissions()->map(function ($permission) {
        return [
            'id' => $permission->id,
            'name' => $permission->name,
            'label' => $permission->label,
            'group' => $permission->group,
        ];
    });

    return response()->json([
        'user' => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'company_id' => $user->company_id,
            'availability_status' => $user->availability_status,
        ],
        'roles' => $roles,
        'permissions' => $permissions,
    ]);
})->middleware('auth:api');

Route::post('send-sms-for-login', [\App\Http\Controllers\Api\AuthController::class, 'sendSmsForLogin']);
Route::post('verify-otp', [\App\Http\Controllers\Api\AuthController::class, 'verifyOtp']);
Route::get('me', [\App\Http\Controllers\Api\AuthController::class, 'me'])->middleware('auth:api');
Route::post('save-subscription-id', [\App\Http\Controllers\Api\AuthController::class, 'saveSubscriptionId'])->middleware('auth:api');

// User Availability Routes
Route::prefix('user/availability')->middleware('auth:api')->group(function () {
    Route::put('status', [\App\Http\Controllers\Api\UserAvailabilityController::class, 'updateStatus']);
    Route::get('status', [\App\Http\Controllers\Api\UserAvailabilityController::class, 'getStatus']);
    Route::get('statuses', [\App\Http\Controllers\Api\UserAvailabilityController::class, 'getAvailableStatuses']);
});

// Order Routes
Route::prefix('orders')->middleware('auth:api')->group(function () {
    Route::get('/', [\App\Http\Controllers\Api\OrderController::class, 'index']);
    Route::get('/{id}', [\App\Http\Controllers\Api\OrderController::class, 'show']);
    Route::put('/items/{orderItemId}/status', [\App\Http\Controllers\Api\OrderController::class, 'updateItemStatus']);
});
