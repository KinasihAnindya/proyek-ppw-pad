<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserBaruNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $userBaru;

    public function __construct(User $userBaru)
    {
        $this->userBaru = $userBaru;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Pengguna Baru Mendaftar via Google')
            ->greeting('Halo, ' . $notifiable->name . '!')
            ->line('Ada pengguna baru yang mendaftar menggunakan akun Google:')
            ->line('Nama : ' . $this->userBaru->name)
            ->line('Email: ' . $this->userBaru->email)
            ->action('Buka Aplikasi', url('/home'))
            ->line('Terima kasih.');
    }

    public function toArray($notifiable)
    {
        return [
            'user_id' => $this->userBaru->id,
            'nama'    => $this->userBaru->name,
            'email'   => $this->userBaru->email,
            'pesan'   => 'Pengguna baru mendaftar via Google: ' . $this->userBaru->name,
        ];
    }
}