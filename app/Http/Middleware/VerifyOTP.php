<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class VerifyOtp
{
    public function handle($request, Closure $next)
    {
        // Check if OTP session exists and user is logged in
        if (Auth::check()) {
            // If OTP is not verified, redirect to the OTP verification page
            if (!session()->has('otp_verified') || !session('otp_verified')) {
                return redirect()->route('verify.otp')->withErrors(['otp' => 'Please verify your OTP.']);
            }
        }
    
        return $next($request);

        return $next($request);
    }
}
