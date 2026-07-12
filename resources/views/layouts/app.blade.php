<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>@yield('title', 'Sanggar Seni Nuansa Official')</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Nunito:wght@400;500;600;700&display=swap');

        :root {
            --coklat-tua: #8b5a2b;
            --coklat-muda: #a56e38;
            --emas: #e9c46a;
            --krem: #fffaf2;
            --border: #e6c8a0;
            --hijau: #2c5a2e;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, #fef9e6 0%, #fff4e0 100%);
            color: #3e2a1f;
        }

        .flash-success, .flash-error {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            padding: 14px 22px;
            border-radius: 14px;
            font-weight: 600;
            font-size: 0.9rem;
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
            animation: slideIn 0.4s ease;
            max-width: 360px;
        }

        .flash-success { background: #2c5a2e; color: white; }
        .flash-error   { background: #e76f51; color: white; }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(60px); }
            to   { opacity: 1; transform: translateX(0); }
        }
    </style>
    @yield('styles')
</head>
<body>

@if(session('success'))
    <div class="flash-success" id="flashMsg">✅ {{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="flash-error" id="flashMsg">❌ {{ session('error') }}</div>
@endif

@yield('content')

<script>
    // Auto dismiss flash
    setTimeout(() => {
        const el = document.getElementById('flashMsg');
        if (el) { el.style.opacity = '0'; el.style.transition = '0.5s'; setTimeout(() => el.remove(), 500); }
    }, 3500);
</script>
@yield('scripts')
</body>
</html>
