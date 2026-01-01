<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Check if onboarding is needed
        if (\App\Http\Controllers\Admin\OnboardingController::needsOnboarding()) {
            return redirect()->route('admin.onboarding.welcome');
        }

        return view('admin.index');
    }

    
}
