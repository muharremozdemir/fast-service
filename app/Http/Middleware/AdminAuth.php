<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Önce session auth kontrolü yap
        if (Auth::check()) {
            $user = Auth::user();
            
            // Lisans kontrolü - suspended sayfası ve companies sayfası hariç
            if (!$request->is('admin/license/suspended') && !$request->is('admin/companies*')) {
                if ($user->company_id) {
                    $company = \App\Models\Company::find($user->company_id);
                    if ($company && $company->license_expires_at) {
                        // Lisans süresi dolmuş mu kontrol et
                        if ($company->isLicenseExpired() || ($company->days_remaining !== null && $company->days_remaining < 0)) {
                            return redirect()->route('admin.license.suspended');
                        }
                    }
                }
            }
            
            // Session geçerli, devam et
            return $next($request);
        }
        
        // Session yok, login sayfasına yönlendir
        return redirect()->route('auth.login');
    }
}

