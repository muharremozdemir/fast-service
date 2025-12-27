<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function sendSmsForLogin(Request $request)
    {
        $user = User::query()->where('phone', $request->phone)->first();

        $otpCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

        // Eski OTP kodlarını kullanılmış olarak işaretle
        DB::table('otp_codes')
            ->where('phone', $user->phone)
            ->where('used', false)
            ->update(['used' => true]);

        // Yeni OTP kodu kaydet
        DB::table('otp_codes')->insert([
            'phone' => $user->phone,
            'code' => $otpCode,
            'user_id' => $user->id,
            'expires_at' => Carbon::now()->addMinutes(10),
            'used' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        netGsmSendSms([$user->phone], $otpCode);
    }

    public function verifyOtp(Request $request)
    {
        // Telefon numarasını temizle
        $phone = preg_replace('/[^0-9]/', '', $request->phone);

        // OTP kodunu kontrol et
        $otp = DB::table('otp_codes')
            ->where('phone', $phone)
            ->where('code', $request->code)
            ->where('used', false)
            ->where('expires_at', '>', now())
            ->first();

        // OTP kodunu kullanılmış olarak işaretle
        DB::table('otp_codes')
            ->where('id', $otp->id)
            ->update(['used' => true]);

        $user = User::query()->find($otp->user_id);

        if ($user){
            $token = JWTAuth::fromUser($user);

            return response()->json([
                'success' => true,
                'message' => 'Başarıyla giriş yaptınız.',
                'token' => $token,
                'token_type' => 'bearer',
                'expires_in' => config('jwt.ttl') * 60, // saniye cinsinden
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'company_id' => $user->company_id,
                ]
            ]);
        }
    }

    public function saveSubscriptionId(Request $request)
    {
        $request->validate([
            'subscription_id' => 'required|string',
        ]);

        $user = $request->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated'
            ], 401);
        }

        $user->subscription_id = $request->subscription_id;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Subscription ID başarıyla kaydedildi.',
            'user' => [
                'id' => $user->id,
                'subscription_id' => $user->subscription_id,
            ]
        ]);
    }

    public function sendLoginSms(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
        ]);

        // Telefon numarası validasyonu
        if (strlen($phone) != 10) {
            return api_error('Geçersiz telefon numarası formatı.');
        }

        // OTP kodu oluştur
        $otpCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

        // SMS mesajı hazırla
        $message = "Giriş kodunuz: " . $otpCode;

        // SMS gönder
        $smsResult = netGsmSendSms([$phone], $message);

        // SMS gönderim sonucunu kontrol et
        if ($smsResult === false) {
            return api_error('SMS gönderilemedi. Lütfen tekrar deneyin.');
        }

        // Telefon numarasını response ile geri dön
        return api_success([
            'phone' => $phone
        ]);
    }
}
