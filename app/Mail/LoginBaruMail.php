<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoginBaruMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;
    public $waktuLogin;
    public $ipAddress;

    public function __construct(User $user, string $waktuLogin, string $ipAddress)
    {
        $this->user = $user;
        $this->waktuLogin = $waktuLogin;
        $this->ipAddress = $ipAddress;
    }

    public function build()
    {
        return $this->subject('Aktivitas Login Baru - ' . config('app.name'))
                    ->view('emails.login_baru');
    }
}