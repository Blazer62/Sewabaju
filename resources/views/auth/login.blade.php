@extends('layouts.app')

@section('title', 'Login Admin - Sanggar Seni Nuansa')

@section('styles')
<style>
    body {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #1a2f28 0%, #2c5a2e 50%, #1a3c1e 100%);
        position: relative;
        overflow: hidden;
    }

    body::before {
        content: '';
        position: fixed;
        inset: 0;
        background: radial-gradient(circle at 20% 30%, rgba(233,196,106,0.08) 0%, transparent 50%),
                    radial-gradient(circle at 80% 70%, rgba(139,90,43,0.08) 0%, transparent 50%);
        pointer-events: none;
    }

    /* Batik pattern bg */
    body::after {
        content: '';
        position: fixed;
        inset: 0;
        background-image:
            radial-gradient(circle, rgba(255,255,255,0.03) 1px, transparent 1px);
        background-size: 30px 30px;
        pointer-events: none;
    }

    .login-wrapper {
        width: 100%;
        max-width: 440px;
        padding: 20px;
        position: relative;
        z-index: 1;
    }

    .login-card {
        background: rgba(255, 250, 242, 0.97);
        border-radius: 32px;
        padding: 3rem 2.5rem;
        box-shadow:
            0 40px 80px rgba(0,0,0,0.4),
            0 0 0 1px rgba(233,196,106,0.3);
        animation: cardIn 0.6s cubic-bezier(0.2, 0.9, 0.4, 1.1);
    }

    @keyframes cardIn {
        from { opacity: 0; transform: translateY(30px) scale(0.96); }
        to   { opacity: 1; transform: translateY(0) scale(1); }
    }

    .login-logo {
        text-align: center;
        margin-bottom: 2rem;
    }

    .login-logo .icon {
        width: 72px;
        height: 72px;
        background: linear-gradient(135deg, #2c5a2e, #1a3c1e);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        margin: 0 auto 1rem;
        box-shadow: 0 8px 24px rgba(44,90,46,0.4);
    }

    .login-logo h1 {
        font-family: 'Playfair Display', serif;
        font-size: 1.6rem;
        color: var(--coklat-tua);
        line-height: 1.2;
    }

    .login-logo p {
        font-size: 0.8rem;
        color: #b87c4f;
        margin-top: 0.3rem;
    }

    .badge-admin {
        display: inline-block;
        background: #f3e1c0;
        color: #8b5a2b;
        padding: 4px 14px;
        border-radius: 30px;
        font-size: 0.7rem;
        font-weight: 700;
        margin-top: 0.6rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .form-group {
        margin-bottom: 1.4rem;
    }

    .form-group label {
        display: block;
        font-weight: 700;
        font-size: 0.85rem;
        color: #5a3e2b;
        margin-bottom: 0.5rem;
    }

    .input-wrap {
        position: relative;
    }

    .input-wrap .icon-left {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 1.1rem;
        pointer-events: none;
    }

    .form-group input {
        width: 100%;
        padding: 12px 16px 12px 44px;
        border: 2px solid #e6c8a0;
        border-radius: 14px;
        font-family: 'Nunito', sans-serif;
        font-size: 0.95rem;
        background: #fffaf2;
        color: #3e2a1f;
        transition: 0.2s;
        outline: none;
    }

    .form-group input:focus {
        border-color: #8b5a2b;
        background: white;
        box-shadow: 0 0 0 4px rgba(139,90,43,0.1);
    }

    .form-group input.is-invalid {
        border-color: #e76f51;
    }

    .invalid-feedback {
        color: #e76f51;
        font-size: 0.78rem;
        margin-top: 4px;
        display: block;
    }

    .remember-row {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 1.6rem;
    }

    .remember-row input[type="checkbox"] {
        width: 18px;
        height: 18px;
        accent-color: #8b5a2b;
        cursor: pointer;
    }

    .remember-row label {
        font-size: 0.85rem;
        color: #5a3e2b;
        cursor: pointer;
        font-weight: 600;
    }

    .btn-login {
        width: 100%;
        padding: 14px;
        background: linear-gradient(135deg, #8b5a2b, #a56e38);
        color: white;
        border: none;
        border-radius: 40px;
        font-family: 'Nunito', sans-serif;
        font-size: 1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 8px 20px rgba(139,90,43,0.35);
        letter-spacing: 0.5px;
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(139,90,43,0.45);
        background: linear-gradient(135deg, #a56e38, #c17b3c);
    }

    .btn-login:active {
        transform: translateY(0);
    }

    .back-link {
        display: block;
        text-align: center;
        margin-top: 1.5rem;
        color: #b87c4f;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 600;
        transition: 0.2s;
    }

    .back-link:hover {
        color: #8b5a2b;
    }

    .security-note {
        margin-top: 1.5rem;
        padding: 12px 16px;
        background: #f0f9f0;
        border-radius: 12px;
        border: 1px solid #c8e6c9;
        text-align: center;
        font-size: 0.75rem;
        color: #2c5a2e;
        font-weight: 600;
    }

    /* ── RESPONSIVE LOGIN ── */
    @media (max-width: 480px) {
        .login-wrapper { padding: 16px; }
        .login-card { padding: 2rem 1.5rem; border-radius: 24px; }
        .login-logo { margin-bottom: 1.5rem; }
        .login-logo .icon { width: 56px; height: 56px; font-size: 1.5rem; border-radius: 16px; }
        .login-logo h1 { font-size: 1.35rem; }
        .login-logo p { font-size: 0.72rem; }
        .form-group label { font-size: 0.8rem; }
        .form-group input { padding: 10px 14px 10px 40px; font-size: 0.9rem; }
        .input-wrap .icon-left { font-size: 1rem; left: 12px; }
        .btn-login { padding: 12px; font-size: 0.95rem; }
        .back-link { font-size: 0.8rem; }
        .security-note { font-size: 0.7rem; padding: 10px 12px; }
    }

    @media (max-width: 360px) {
        .login-card { padding: 1.5rem 1rem; border-radius: 20px; }
        .login-logo h1 { font-size: 1.2rem; }
        .login-logo .icon { width: 48px; height: 48px; font-size: 1.3rem; }
        .form-group { margin-bottom: 1rem; }
    }
</style>
@endsection

@section('content')
<div class="login-wrapper">
    <div class="login-card">
        <div class="login-logo">
            <div class="icon">🔐</div>
            <h1>Sanggar Seni<br>Nuansa Official</h1>
            <p>Panel Manajemen Busana</p>
            <span class="badge-admin">Admin Only</span>
        </div>

        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email Admin</label>
                <div class="input-wrap">
                    <span class="icon-left">📧</span>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="admin@nuansa.id"
                        class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                        required
                        autofocus
                    >
                </div>
                @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrap">
                    <span class="icon-left">🔑</span>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Masukkan password"
                        class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                        required
                    >
                </div>
                @error('password')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="remember-row">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Ingat saya</label>
            </div>

            <button type="submit" class="btn-login">
                🚀 Masuk ke Panel Admin
            </button>
        </form>

        <a href="{{ route('penyewa.index') }}" class="back-link">
            ← Kembali ke Beranda Penyewa
        </a>

        <div class="security-note">
            🛡️ Halaman ini hanya untuk admin resmi Sanggar Seni Nuansa
        </div>
    </div>
</div>
@endsection
