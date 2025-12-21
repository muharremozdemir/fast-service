<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LicenseController extends Controller
{
    public function suspended()
    {
        $user = Auth::user();
        $company = null;
        
        if ($user && $user->company_id) {
            $company = \App\Models\Company::find($user->company_id);
            
            // Lisans kontrolü - eğer lisans geçerliyse ana sayfaya yönlendir
            if ($company) {
                // Lisans tanımlı değilse veya süresi dolmamışsa raporlar sayfasına yönlendir
                if (!$company->license_expires_at) {
                    // Lisans tanımlı değil, raporlar sayfasına yönlendir
                    return redirect()->route('admin.reports.index');
                }
                
                // Lisans süresi kontrolü
                $daysRemaining = $company->days_remaining;
                
                // Eğer lisans süresi dolmamışsa (days_remaining > 0 veya null değilse ve pozitifse)
                if ($daysRemaining !== null && $daysRemaining > 0) {
                    // Lisans geçerli, raporlar sayfasına yönlendir
                    return redirect()->route('admin.reports.index')->with('success', 'Lisansınız yenilenmiştir. Sisteme hoş geldiniz!');
                }
            }
        }
        
        return view('admin.license.suspended', compact('company'));
    }
}
