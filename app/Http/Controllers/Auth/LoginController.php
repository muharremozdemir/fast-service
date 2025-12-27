<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\OtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth;
use Spatie\Permission\Models\Role;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|max:20',
        ]);

        // Telefon numarasını temizle (sadece rakamlar)
        $phone = preg_replace('/[^0-9]/', '', $request->phone);

        // Kullanıcıyı bul
        $user = User::where('phone', $phone)->first();

        // AJAX isteği ise JSON döndür
        $isAjax = $request->expectsJson() || $request->ajax();

        if (!$user) {
            if ($isAjax) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bu telefon numarasına kayıtlı kullanıcı bulunamadı.'
                ], 422);
            }
            return back()->withErrors(['phone' => 'Bu telefon numarasına kayıtlı kullanıcı bulunamadı.'])->withInput();
        }

        if (!$user->email) {
            if ($isAjax) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kullanıcı email adresi bulunamadı.'
                ], 422);
            }
            return back()->withErrors(['phone' => 'Kullanıcı email adresi bulunamadı.'])->withInput();
        }

        // 6 haneli OTP kodu oluştur
        $otpCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

        // Eski OTP kodlarını kullanılmış olarak işaretle
        DB::table('otp_codes')
            ->where('phone', $phone)
            ->where('used', false)
            ->update(['used' => true]);

        // Yeni OTP kodu kaydet
        DB::table('otp_codes')->insert([
            'phone' => $phone,
            'code' => $otpCode,
            'user_id' => $user->id,
            'expires_at' => Carbon::now()->addMinutes(10),
            'used' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        netGsmSendSms([$phone], $otpCode);

        // Email ile OTP gönder
        //try {
        //    Mail::to($user->email)->send(new OtpMail($otpCode, $user->name, 10));
        //} catch (\Exception $e) {
        //    if ($isAjax) {
        //        return response()->json([
        //            'success' => false,
        //            'message' => 'OTP kodu gönderilirken bir hata oluştu. Lütfen tekrar deneyin.'
        //        ], 500);
        //    }
        //    return back()->withErrors(['phone' => 'OTP kodu gönderilirken bir hata oluştu. Lütfen tekrar deneyin.'])->withInput();
        //}

        // Phone'u session'a kaydet (kalıcı olarak)
        session()->put('phone', $phone);

        // AJAX isteği ise JSON döndür
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'OTP kodu email adresinize gönderildi.',
                'phone' => $phone
            ]);
        }

        return redirect()->route('auth.verify-otp')->with('success', 'OTP kodu email adresinize gönderildi.');
    }

    public function showVerifyOtpForm()
    {
        $phone = session('phone');
        if (!$phone) {
            return redirect()->route('auth.login');
        }

        return view('auth.verify-otp', compact('phone'));
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'code' => 'required|string|size:6',
        ]);

        $phone = session('phone');
        if (!$phone) {
            return redirect()->route('auth.login');
        }

        // Telefon numarasını temizle
        $phone = preg_replace('/[^0-9]/', '', $phone);

        // OTP kodunu kontrol et
        $otp = DB::table('otp_codes')
            ->where('phone', $phone)
            ->where('code', $request->code)
            ->where('used', false)
            ->where('expires_at', '>', now())
            ->first();

        // AJAX isteği kontrolü
        $isAjax = $request->expectsJson() || $request->ajax();

        if (!$otp) {
            if ($isAjax) {
                return response()->json([
                    'success' => false,
                    'message' => 'Geçersiz veya süresi dolmuş OTP kodu.'
                ], 422);
            }
            return back()->withErrors(['code' => 'Geçersiz veya süresi dolmuş OTP kodu.'])->withInput();
        }

        // OTP kodunu kullanılmış olarak işaretle
        DB::table('otp_codes')
            ->where('id', $otp->id)
            ->update(['used' => true]);

        // Kullanıcıyı login et
        $user = User::find($otp->user_id);
        if ($user) {
            // JWT token oluştur
            $token = JWTAuth::fromUser($user);

            // Session login (web için)
            Auth::login($user, true);

            // JWT token'ı session'a kaydet (mobil uygulama için)
            session(['jwt_token' => $token]);
            session()->forget('phone');

            // API isteği mi kontrol et
            if ($request->expectsJson() || $request->wantsJson()) {
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

            // JWT token'ı cookie'ye set et (web route'larında JWT middleware için)
            // Cookie süresi dakika cinsinden, cookie() helper'ı saniye bekliyor
            $cookieMinutes = config('jwt.ttl', 60);
            $cookieSeconds = $cookieMinutes * 60;

            // Admin kontrolü - admin ise companies sayfasına yönlendir
            $isAdmin = false;
            $adminRole = Role::where('name', 'admin')
                ->where('company_id', 0)
                ->first();
            if ($adminRole) {
                $isAdmin = DB::table('model_has_roles')
                    ->where('model_type', get_class($user))
                    ->where('model_id', $user->id)
                    ->where('role_id', $adminRole->id)
                    ->where('company_id', 0)
                    ->exists();
            }

            // Admin ise companies sayfasına, değilse mevcut yönlendirmeye git
            $redirectRoute = $isAdmin
                ? route('admin.companies.index')
                : route('admin.reports.index');

            // AJAX isteği ise JSON döndür
            if ($isAjax) {
                return response()->json([
                    'success' => true,
                    'message' => 'Başarıyla giriş yaptınız.',
                    'redirect_url' => $redirectRoute,
                    'token' => $token,
                ])->cookie('jwt_token', $token, $cookieSeconds, '/', null, false, true, false, 'lax');
            }

            return redirect()->intended($redirectRoute)
                ->with('success', 'Başarıyla giriş yaptınız.')
                ->with('jwt_token', $token)
                ->cookie('jwt_token', $token, $cookieSeconds, '/', null, false, true, false, 'lax');
        }

        return back()->withErrors(['code' => 'Kullanıcı bulunamadı.'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // JWT token cookie'sini temizle
        $cookie = cookie()->forget('jwt_token');

        return redirect()->route('auth.login')
            ->with('success', 'Başarıyla çıkış yaptınız.')
            ->cookie($cookie);
    }
}
