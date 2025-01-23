<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        {
            $request->authenticate();
        
            $request->session()->regenerate();
        
            // Generate and send OTP
            $otp = Str::random(6); // Generate a 6-character OTP
            $user = Auth::user(); // Get the authenticated user
        
            // Save the OTP in the user's session
            session(['otp' => $otp]);
        
            // Send OTP to the user's email
            
            Mail::send('email.index', ['otp' => $otp, 'user' => $user], function($message) use ($user) {
                $message->to($user->email)
                        ->subject('Your OTP Code');
            });
    
        
            // Redirect to OTP verification page
            return redirect()->route('verify.otp')->with('status', 'OTP has been sent to your email.');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function sendOtp(Request $request)
    {
        $otp = Str::random(6); // Generate a 6-character OTP
        $user = Auth::user(); // Get the authenticated user

        // Save the OTP in the user's session or database
        session(['otp' => $otp]);

        // Send OTP to the user's email
        Mail::send([], [], function($message) use ($user, $otp) {
            $message->to($user->email)
                    ->subject('Your OTP Code')
                    ->setBody("Your OTP code is: $otp");
        });

        return back()->with('status', 'OTP has been sent to your email.');
    }

    public function verifyOtp(Request $request)
    {
        $otp = $request->input('otp');
        
        // Check if the OTP matches the one stored in the session
        if ($otp === session('otp')) {
            // OTP is correct, log the user in
            session()->forget('otp');
            return redirect()->intended(RouteServiceProvider::HOME);
        } else {
            // OTP is incorrect
            return back()->withErrors(['otp' => 'Invalid OTP']);
        }


    }
}