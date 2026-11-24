<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Aktivitas Login Baru</title></head>
<body style="font-family: Arial, sans-serif; color: #333;">
    <h3>Halo {{ $user->name }},</h3>
    <p>Akun Anda baru saja login menggunakan Google SSO dengan detail berikut:</p>
    <ul>
        <li><b>Waktu Login:</b> {{ $waktuLogin }}</li>
        <li><b>Alamat IP:</b> {{ $ipAddress }}</li>
    </ul>
    <p>Jika ini bukan Anda, segera hubungi administrator.</p>
</body>
</html>