<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktivasi Akun</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            max-width: 500px;
            width: 100%;
            padding: 40px;
            text-align: center;
        }

        .icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 40px;
        }

        .icon.success {
            background-color: #d4edda;
            color: #28a745;
        }

        .icon.error {
            background-color: #f8d7da;
            color: #dc3545;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
            font-size: 28px;
        }

        .message {
            color: #666;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .info-box {
            background-color: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 15px;
            margin: 20px 0;
            text-align: left;
        }

        .info-box strong {
            display: block;
            color: #333;
            margin-bottom: 5px;
        }

        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #999;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container">
        @if($success)
        <div class="icon success">✓</div>
        <h1>Aktivasi Berhasil!</h1>
        @else
        <div class="icon error">✕</div>
        <h1>Aktivasi Gagal</h1>
        @endif


        @if($success && isset($user) && !isset($already_activated))
        <div class="info-box">
            <strong>Informasi Login:</strong>
            Email: {{ $user->email }}<br>
            Password: 12345678
        </div>
        <p style="color: #dc3545; margin-bottom: 20px;">
            <em>⚠️ Harap ubah password Anda setelah login pertama kali!</em>
        </p>
        @endif

        <a href="{{ route('login') }}" class="btn" target="_blank">
            {{ $success ? 'Login Sekarang' : 'Kembali ke Halaman Login' }}
        </a>

        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}</p>
        </div>
    </div>
</body>

</html>