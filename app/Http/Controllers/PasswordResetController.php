<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PasswordResetController extends Controller
{
      /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\View\View
     */
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password'); // Pastikan Anda memiliki view ini
    }

    public function showResetForm($token = null)
    {
        return view('auth.passwords.reset')->with(['token' => $token]);
    }

    /**
     * Handle sending the password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        // Validasi input email
        $request->validate([
            'email' => 'required|email',
        ]);

        // Kirim link reset password
        $status = Password::sendResetLink($request->only('email'));

        // Cek apakah pengiriman berhasil
        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', __($status)); // Menampilkan pesan sukses
        }

        return back()->withErrors(['email' => __($status)]); // Menampilkan pesan error
    }
}
