<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Routing\Controller;

class OtpController extends Controller
{
    /**
     * Show the OTP verification form.
     */
    public function show()
    {
        return view('auth.verify-otp');
    }

    /**
     * Handle the OTP verification.
     */
    public function verify(Request $request)
    {
        $request->validate(['otp' => 'required']);

        $user = Auth::user();

        if ($user->otp_code === $request->otp && $user->otp_expires_at->isFuture()) {
            $user->email_verified_at = now();
            $user->otp_code = null;
            $user->otp_expires_at = null;
            $user->save();

            return redirect('/products')->with('status', 'Email verified successfully!');
        }

        return back()->withErrors(['otp' => 'Invalid or expired OTP']);
    }
}
