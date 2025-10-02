<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktivasi Akun</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .container {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 30px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #4CAF50;
            margin: 0;
        }

        .content {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .button {
            display: inline-block;
            padding: 12px 30px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
            text-align: center;
        }

        .button:hover {
            background-color: #45a049;
        }

        .footer {
            text-align: center;
            color: #666;
            font-size: 12px;
            margin-top: 20px;
        }

        .info {
            background-color: #e7f3ff;
            padding: 15px;
            border-left: 4px solid #2196F3;
            margin: 15px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Aktivasi Akun</h1>
        </div>

        <div class="content">
            <p>Halo <strong>{{ $user->name }}</strong>,</p>

            <p>Selamat datang! Akun Anda telah berhasil dibuat.</p>

            <div class="info">
                <strong>Detail Akun:</strong><br>
                Email: {{ $user->email }}<br>
                Role: {{ ucfirst($user->role) }}
            </div>

            <p>Untuk mengaktifkan akun Anda, silakan klik tombol di bawah ini:</p>

            <div style="text-align: center;">
                <a href="{{ $activationLink }}" class="button">Aktivasi Akun</a>
            </div>

            <p>Atau copy dan paste link berikut ke browser Anda:</p>
            <p style="word-break: break-all; color: #0066cc;">{{ $activationLink }}</p>

            <p><strong>Password default:</strong> 12345678</p>
            <p style="color: #ff6b6b;"><em>Harap ubah password Anda setelah login pertama kali.</em></p>
        </div>

        <div class="footer">
            <p>Email ini dikirim secara otomatis, mohon tidak membalas email ini.</p>
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>

</html>