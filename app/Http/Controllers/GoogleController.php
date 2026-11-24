<?php

namespace App\Http\Controllers;

use App\Jobs\KirimEmailSelamatDatang;
use App\Mail\LoginBaruMail;
use App\Models\User;
use App\Notifications\UserBaruNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')
            ->with(['prompt' => 'select_account'])
            ->redirect();
    }

    public function callback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Throwable $e) {
            return redirect()->route('login')
                ->with('error', 'Login dengan Google gagal atau dibatalkan. Silakan coba lagi.');
        }

        // Validasi domain kampus @mail.ugm.ac.id 
        if (! str_ends_with($googleUser->getEmail(), '@mail.ugm.ac.id')) {
            return redirect()->route('login')
                ->with('error', 'Akses ditolak! Hanya email @mail.ugm.ac.id yang diizinkan.');
        }

        $user = User::where('google_id', $googleUser->getId())
            ->orWhere('email', $googleUser->getEmail())
            ->first();

        $userBaru = false;

        if (! $user) {
            $user = User::create([
                'name'              => $googleUser->getName(),
                'email'             => $googleUser->getEmail(),
                'password'          => Hash::make(Str::random(24)),
                'google_id'         => $googleUser->getId(),
                'avatar'            => $googleUser->getAvatar(),
                'level'             => 'user',
                'email_verified_at' => now(),
            ]);
            $userBaru = true;
        } else {
            $user->update([
                'google_id' => $googleUser->getId(),
                'avatar'    => $googleUser->getAvatar(),
            ]);
        }

        Auth::login($user, true);
        $request->session()->regenerate();

        // Kirim email aktivitas login baru setiap kali user login
        Mail::to($user->email)->queue(
            new LoginBaruMail($user, now()->format('d M Y H:i:s'), $request->ip())
        );

        // User baru > kirim email selamat datang & notifikasi ke admin
        if ($userBaru) {
            KirimEmailSelamatDatang::dispatch($user);

            $admin = User::where('level', 'admin')->first();
            if ($admin) {
                $admin->notify(new UserBaruNotification($user));
            }
        }

        return redirect()->intended('/home')
            ->with('success', 'Selamat datang, ' . $user->name . '!');
    }
}