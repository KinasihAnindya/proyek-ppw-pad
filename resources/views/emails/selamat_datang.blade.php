<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Selamat Datang</title></head>
<body style="font-family: Arial, sans-serif; color: #333;">
    <h2>Halo {{ $user->name }},</h2>
    <p>Terima kasih telah mendaftar di <b>{{ config('app.name') }}</b> menggunakan akun Google (<b>{{ $user->email }}</b>).</p>
    <p>Mulai sekarang Anda dapat login cukup dengan menekan tombol <b>Login dengan Google</b>.</p>
    <p>
        <a href="{{ url('/home') }}" style="background:#0d6efd;color:#fff;padding:10px 18px;border-radius:6px;text-decoration:none;">
            Buka Aplikasi
        </a>
    </p>
    <br>
    <p>Salam,<br><b>Tim {{ config('app.name') }}</b></p>
</body>
</html>