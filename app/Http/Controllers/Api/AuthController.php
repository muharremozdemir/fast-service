<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\NetGsmService;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function sendSmsForLogin(Request $request, NetGsmService $netGsmService)
    {
        $phone = $request->phone;
        // Telefon numarası validasyonu
        if (strlen($phone) != 13) {
            return api_error('Geçersiz telefon numarası formatı.');
        }

        $user = User::query()->where('phone', $phone)->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Bu telefon numarasına ait kullanıcı bulunamadı.'
            ], 400);
        }

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

        $message = "Giriş kodunuz: " . $otpCode;

        $netGsmService->send([$user->phone], $message);

        return response()->json([
            'status' => 'success',
            'data' => [
                "phone" => $user->phone
            ]
        ]);
    }

    public function verifyOtp(Request $request)
    {
        // Telefon numarasını temizle
        $phone = $request->phone;

        // OTP kodunu kontrol et
        $otp = DB::table('otp_codes')
            ->where('phone', $phone)
            ->where('code', $request->verification_code)
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
                'expires_in' => 604800 * 4, // saniye cinsinden
                'user' => [
                    'id' => $user->id,
                    'name_surname' => $user->name_surname,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'company_id' => $user->company_id,
                    'availability_status' => $user->availability_status,
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

        $user->player_id = $request->subscription_id;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Subscription ID başarıyla kaydedildi.',
            'user' => [
                'id' => $user->id,
                'subscription_id' => $user->player_id,
            ]
        ]);
    }

    public function sendLoginSms(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
        ]);

        // Telefon numarasını temizle ve formatla
        $phone = $this->make_mobile($request->phone);

        // Telefon numarası validasyonu
        if (strlen($phone) != 10) {
            return api_error('Geçersiz telefon numarası formatı.');
        }

        // OTP kodu oluştur
        $otpCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

        // SMS mesajı hazırla
        $message = "Giriş kodunuz: " . $otpCode;

        // SMS gönder
        $smsResult = $this->netGsmSendSms([$phone], $message);

        // SMS gönderim sonucunu kontrol et
        if ($smsResult === false) {
            return api_error('SMS gönderilemedi. Lütfen tekrar deneyin.');
        }

        // Telefon numarasını response ile geri dön
        return response()->json([
            'status'  => 'success',
            'data'    => $phone
        ]);
    }

    function make_mobile($mobile)
    {
        return substr(str_replace(['\0', '+', ')', '(', '-', ' ', '\t'], '', $mobile), -10);
    }

    function netGsmSendSms($numbers, $message)
    {
        if (is_array($numbers)){
            $numbersXml = '';
            foreach ($numbers as $number) {
                $numbersXml .= '<no>'.$number.'</no>';
            }
        }else{
            $numbersXml = '<no>'.$numbers.'</no>';
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
             <mainbody>
             <header>
             <company dil="TR">Netgsm</company>
             <usercode>8503029456</usercode>
             <password>8712.D3</password>
             <type>1:n</type>
             <msgheader>PastService</msgheader>
             </header>
             <body>
             <msg>
             <![CDATA['.$message.']]>
             </msg>
             '. $numbersXml .'
             </body>
             </mainbody>';

        // Guzzle client oluştur
        $client = new Client();

        try {
            $response = $client->post('https://api.netgsm.com.tr/sms/send/xml', [
                'headers' => [
                    'Content-Type' => 'text/xml',
                ],
                'body' => $xml,
                'timeout' => 30,
                'verify' => false, // SSL sertifikası doğrulaması kapalı
            ]);

            // İstek başarılı olduğunda sonucu al
            return $response->getBody()->getContents();
        } catch (\Exception $e) {
            Log::error('SMS Gönderiminde Hata: ' . $e->getMessage());
            return false;
        }
    }

    public function me()
    {
        $user = Auth::user();

        return response()->json([
            "status" => "success",
            "data" => [
                "user" => [
                    'id' => $user->id,
                    'name_surname' => $user->name_surname,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'company_id' => $user->company_id,
                    'subscription_id' => $user->subscription_id,
                    'availability_status' => $user->availability_status,
                ]
            ]
        ]);
    }
}
