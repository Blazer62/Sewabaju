@extends('layouts.app')

@section('title', 'Sanggar Seni Nuansa Official - Rental Busana Adat & Pendamping Budaya')

@section('styles')
<style>
    /* ── RESET & BASE ── */
    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
        font-family: 'Nunito', sans-serif;
        background: linear-gradient(135deg, #fef9e6 0%, #fff4e0 100%);
        color: #3e2a1f;
        line-height: 1.6;
        -webkit-tap-highlight-color: transparent;
        -webkit-font-smoothing: antialiased;
    }

    img { max-width: 100%; height: auto; }

    .container { max-width: 1200px; margin: 0 auto; padding: 0 1.5rem; position: relative; z-index: 1; }

    /* ── NAVBAR ── */
    .header-wrapper {
        position: sticky;
        top: 0;
        z-index: 1000;
        background: rgba(255,250,242,0.92);

        border-bottom: 1px solid rgba(230,200,160,0.3);
    }

    .header-wrapper.scrolled { box-shadow: 0 4px 20px rgba(139,90,43,0.08); }

    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 0;
        gap: 1rem;
    }

    .logo-img {
        display: block;
        height: 44px;
        width: auto;
        border-radius: 6px;
    }

    .logo p { font-size: 0.68rem; color: #b87c4f; font-weight: 500; margin-top: 2px; display: none; }

    .burger-menu, .menu-overlay, .mobile-drawer { display: none; }

    .nav-links { display: flex; align-items: center; gap: 0.5rem; }

    .nav-links > a, .dropdown > a {
        text-decoration: none;
        color: #5a3e2b;
        font-weight: 600;
        font-size: 0.88rem;
        padding: 0.5rem 1rem;
        border-radius: 10px;
        transition: all 0.2s;
        display: inline-block;
    }

    .nav-links > a:hover, .dropdown > a:hover { background: rgba(139,90,43,0.06); color: var(--coklat-tua); }

    .nav-links > a.active, .dropdown > a.active { color: var(--coklat-tua); background: rgba(139,90,43,0.08); }

    .dropdown { position: relative; display: inline-block; }

    .dropdown-content {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background: white;
        min-width: 200px;
        box-shadow: 0 12px 32px rgba(0,0,0,0.1);
        border-radius: 16px;
        z-index: 1;
        border: 1px solid rgba(230,200,160,0.3);
        overflow: hidden;
        padding: 6px;
        padding-top: 8px;
        margin-top: -4px;
    }

    .dropdown-content a {
        color: #5a3e2b;
        padding: 10px 14px;
        text-decoration: none;
        display: block;
        font-weight: 500;
        font-size: 0.85rem;
        border-radius: 10px;
        transition: 0.15s;
    }

    .dropdown-content a:hover { background: #f3e1c0; color: #8b5a2b; }

    .dropdown:hover .dropdown-content { display: block; }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, var(--coklat-tua), var(--coklat-muda));
        color: white;
        padding: 0.8rem 2rem;
        border-radius: 40px;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.9rem;
        transition: all 0.25s;
        border: none;
        cursor: pointer;
        font-family: 'Nunito', sans-serif;
        box-shadow: 0 4px 14px rgba(139,90,43,0.25);
    }

    .btn:hover { box-shadow: 0 8px 24px rgba(139,90,43,0.35); }

    /* ── HERO ── */
    .hero {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 3rem;
        margin: 2.5rem 0 4rem;
        background: linear-gradient(135deg, rgba(255,250,242,0.8), rgba(255,244,224,0.6));
        border-radius: 48px;
        padding: 3rem 3.5rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.03), 0 20px 40px rgba(139,90,43,0.06);
        border: 1px solid rgba(230,200,160,0.2);
        position: relative;
        overflow: hidden;
    }

    .hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(233,196,106,0.08) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .hero-text { flex: 1; min-width: 280px; position: relative; }

    .hero-text .badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: linear-gradient(135deg, #f3e1c0, #edcfa0);
        padding: 0.4rem 1.2rem;
        border-radius: 30px;
        font-size: 0.78rem;
        font-weight: 700;
        color: #8b5a2b;
        margin-bottom: 1.2rem;
        letter-spacing: 0.3px;
    }

    .hero-text h1 {
        font-family: 'Playfair Display', serif;
        font-size: 2.8rem;
        line-height: 1.2;
        margin-bottom: 1rem;
        color: #2c1f12;
        letter-spacing: -0.5px;
    }

    .hero-text p {
        font-size: 1.05rem;
        color: #5e4532;
        margin-bottom: 2rem;
        max-width: 520px;
        line-height: 1.7;
    }

    .hero-image {
        flex: 0 0 420px;
        position: relative;
    }

    .hero-image .img-wrap {
        width: 100%;
        aspect-ratio: 5/4;
        border-radius: 28px;
        background: linear-gradient(135deg, #e9d9c4, #dcc8ae);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        box-shadow: 0 20px 40px -10px rgba(0,0,0,0.12);
        border: 2px solid rgba(255,255,255,0.4);
        position: relative;
    }

    .hero-image .img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .hero-image .img-placeholder {
        font-size: 3.5rem;
        opacity: 0.6;
    }

    /* ── SECTION COMMON ── */
    section {
        scroll-margin-top: 90px;
        margin-bottom: 3.5rem;
    }

    .section-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        color: #3e2a1f;
        margin-bottom: 0.5rem;
        position: relative;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .section-title::after {
        content: '';
        display: block;
        height: 3px;
        width: 100%;
        max-width: 80px;
        background: linear-gradient(90deg, var(--coklat-tua), var(--emas));
        border-radius: 3px;
        position: absolute;
        bottom: -8px;
        left: 0;
    }

    .section-subtitle {
        color: #b07c4f;
        font-size: 0.9rem;
        margin-top: 1rem;
        margin-bottom: 1.5rem;
        max-width: 600px;
    }

    /* ── ABOUT ── */
    .about-card {
        background: white;
        border-radius: 24px;
        padding: 2.5rem 3rem;
        border: 1px solid rgba(230,200,160,0.15);
        box-shadow: 0 1px 3px rgba(0,0,0,0.03), 0 8px 24px rgba(0,0,0,0.04);
    }

    .about-content {
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
        align-items: center;
    }

    .about-text { flex: 1; min-width: 260px; }

    .about-text p { font-size: 0.95rem; color: #4a3424; margin-bottom: 1rem; line-height: 1.7; }

    .about-text .highlight {
        display: inline-block;
        background: linear-gradient(135deg, #f3e1c0, #edcfa0);
        padding: 0.2rem 0.8rem;
        border-radius: 6px;
        font-weight: 600;
    }

    /* ── TABS ── */
    .layanan-tabs {
        display: flex;
        gap: 0.6rem;
        flex-wrap: wrap;
        margin: 1.5rem 0;
        padding: 4px;
        background: rgba(255,250,242,0.6);
        border-radius: 40px;
        border: 1px solid rgba(230,200,160,0.2);
        width: fit-content;
    }

    .tab-btn {
        background: none;
        border: none;
        padding: 0.6rem 1.4rem;
        font-size: 0.88rem;
        font-weight: 700;
        color: #5a3e2b;
        cursor: pointer;
        border-radius: 30px;
        transition: all 0.2s;
        font-family: 'Nunito', sans-serif;
    }

    .tab-btn:hover { background: rgba(139,90,43,0.06); }

    .tab-btn.active {
        background: var(--coklat-tua);
        color: white;
        box-shadow: 0 4px 12px rgba(139,90,43,0.2);
    }

    .tab-content { display: none; }

    .tab-content.active { display: block; animation: fadeIn 0.35s ease; }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(12px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* ── SEARCH ── */
    .global-search-wrap {
        display: flex;
        justify-content: center;
        margin: 1rem 0 1.5rem;
    }
    .global-search-box {
        display: flex;
        align-items: center;
        background: white;
        border-radius: 60px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        border: 2px solid rgba(200,184,152,0.3);
        max-width: 520px;
        width: 100%;
        transition: border-color 0.25s, box-shadow 0.25s;
        padding: 0 6px 0 18px;
    }
    .global-search-box:focus-within {
        border-color: var(--coklat-tua);
        box-shadow: 0 2px 20px rgba(200,184,152,0.2);
    }
    .gs-icon { width: 20px; height: 20px; color: #b07c4f; flex-shrink: 0; }
    .global-search-box input {
        flex: 1;
        padding: 14px 12px;
        border: none;
        font-size: 0.95rem;
        outline: none;
        font-family: 'Nunito', sans-serif;
        background: transparent;
        min-width: 0;
    }
    .gs-clear {
        background: none;
        border: none;
        font-size: 1.4rem;
        color: #b07c4f;
        cursor: pointer;
        padding: 0 14px;
        line-height: 1;
        font-family: 'Nunito', sans-serif;
        opacity: 0.6;
        transition: opacity 0.2s;
    }
    .gs-clear:hover { opacity: 1; }

    .search-info-global {
        text-align: center;
        margin: -0.5rem 0 1.2rem;
        font-size: 0.82rem;
        color: #b07c4f;
    }
    .search-section { margin-bottom: 2rem; }
    .search-section-title {
        font-size: 0.95rem;
        color: #5a3e2b;
        margin-bottom: 0.8rem;
        padding-bottom: 0.4rem;
        border-bottom: 1px solid rgba(200,184,152,0.3);
    }

    /* ── CARDS ── */
    .tari-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .tari-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.03), 0 4px 12px rgba(0,0,0,0.04);
        border: 1px solid rgba(230,200,160,0.15);
    }

    .image-container {
        width: 100%;
        aspect-ratio: 4/3;
        background: linear-gradient(135deg, #f0e6d6, #e8dcc8);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        position: relative;
    }

    .costume-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        position: relative;
        z-index: 1;
    }

    .card-body { padding: 16px; }

    .card-body h3 {
        font-family: 'Playfair Display', serif;
        font-size: 1rem;
        color: #3e2a1f;
        margin-bottom: 8px;
    }

    .tari-desc {
        font-size: 0.75rem;
        color: #7a5a3a;
        line-height: 1.4;
        margin-bottom: 10px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .ketersediaan-label {
        font-size: 0.72rem;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 20px;
        margin-bottom: 10px;
        display: inline-block;
    }
    .ketersediaan-label.tersedia { background: #e8f5e9; color: #2e7d32; }
    .ketersediaan-label.disewa { background: #fff3e0; color: #e65100; }
    .ketersediaan-label.tidak_tersedia { background: #ffebee; color: #c62828; }

    .aksesoris-individual {
        background: #fdfaf5;
        border-radius: 12px;
        padding: 10px;
        margin-bottom: 12px;
        border: 1px solid rgba(230,200,160,0.2);
    }

    .aksesoris-title {
        font-weight: 700;
        font-size: 0.7rem;
        margin-bottom: 8px;
        color: var(--coklat-tua);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .aksesoris-list-individual { display: flex; flex-direction: column; gap: 5px; }

    .aksesoris-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 5px 10px;
        background: white;
        border-radius: 8px;
        border: 1px solid rgba(230,200,160,0.15);
        font-size: 0.7rem;
        transition: 0.15s;
    }

    .aksesoris-item:hover { border-color: rgba(230,200,160,0.4); }

    .aksesoris-label { flex: 1; font-weight: 600; color: #5a3a2a; }

    .no-result {
        text-align: center;
        padding: 3rem 2rem;
        color: #b07c4f;
        font-size: 0.9rem;
        background: white;
        border-radius: 20px;
        border: 1px dashed rgba(230,200,160,0.4);
    }

    .load-more-wrap { text-align: center; margin-top: 1.5rem; }
    .load-more-btn {
        background: white;
        border: 2px solid #c8b898;
        color: #5a3e2b;
        padding: 0.7rem 2.5rem;
        border-radius: 40px;
        font-family: 'Nunito', sans-serif;
        font-size: 0.85rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s;
    }
    .load-more-btn:hover { background: #c8b898; color: white; }

    .pagination-wrap {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.8rem;
        margin-top: 1.8rem;
    }
    .page-btn {
        background: white;
        border: 2px solid #c8b898;
        color: #5a3e2b;
        padding: 0.5rem 1.2rem;
        border-radius: 30px;
        font-family: 'Nunito', sans-serif;
        font-size: 0.8rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s;
    }
    .page-btn:hover { background: #c8b898; color: white; }
    .page-info {
        font-family: 'Nunito', sans-serif;
        font-size: 0.8rem;
        color: #b07c4f;
        font-weight: 700;
        min-width: 40px;
        text-align: center;
    }

    /* ── KONTAK ── */
    .kontak-card-section {
        background: white;
        border-radius: 24px;
        padding: 2.5rem 3rem;
        border: 1px solid rgba(230,200,160,0.15);
        box-shadow: 0 1px 3px rgba(0,0,0,0.03), 0 8px 24px rgba(0,0,0,0.04);
    }

    .kontak-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
        gap: 1rem;
        margin-top: 1.5rem;
    }

    .kontak-link {
        background: #fdfaf5;
        padding: 1.5rem 1.2rem;
        border-radius: 16px;
        text-align: center;
        text-decoration: none;
        color: #5a3e2b;
        display: block;
        border: 1px solid rgba(230,200,160,0.15);
        position: relative;
    }

    .kontak-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: 16px;
        right: 16px;
        height: 4px;
        border-radius: 0 0 4px 4px;
        transition: height 0.2s;
    }

    .kontak-link:hover {
        background: #fff8f0;
        border-color: rgba(230,200,160,0.4);
    }

    .kontak-link:hover::before { height: 6px; }

    .kontak-link .icon { font-size: 1.8rem; margin-bottom: 0.6rem; width: 1.8rem; height: 1.8rem; display: inline-flex; align-items: center; justify-content: center; }
    .kontak-link .icon svg { width: 100%; height: 100%; display: block; }
    .kontak-link h4 { font-size: 0.95rem; margin-bottom: 0.3rem; color: var(--coklat-tua); }
    .kontak-link p { font-size: 0.78rem; color: #7a5a3a; word-break: break-word; }
    .kontak-link .action { font-size: 0.7rem; font-weight: 700; margin-top: 6px; display: inline-block; }

    .kontak-link.whatsapp::before   { background: #25D366; }
    .kontak-link.instagram::before  { background: linear-gradient(135deg, #F58529, #DD2A7B); }
    .kontak-link.tiktok::before     { background: #000; }
    .kontak-link.email-card::before { background: #EA4335; }
    .kontak-link.location::before   { background: #34A853; }

    .kontak-link.whatsapp .action   { color: #25D366; }
    .kontak-link.instagram .action  { color: #DD2A7B; }
    .kontak-link.tiktok .action     { color: #000; }
    .kontak-link.email-card .action { color: #EA4335; }

    /* ── FOOTER ── */
    .footer {
        background: linear-gradient(135deg, #3e2a1f, #2c1f12);
        color: rgba(200,169,122,0.9);
        text-align: center;
        padding: 2.5rem 1.5rem;
        margin-top: 4rem;
        font-size: 0.85rem;
    }

    .footer-inner { max-width: 1200px; margin: 0 auto; }

    .footer .brand {
        font-family: 'Playfair Display', serif;
        font-size: 1.2rem;
        color: #dba370;
        margin-bottom: 0.5rem;
    }

    .footer a {
        color: var(--emas);
        text-decoration: none;
        font-weight: 700;
        transition: 0.2s;
    }

    .footer a:hover { color: #f0d080; text-decoration: underline; }

    .footer .divider {
        width: 40px;
        height: 2px;
        background: rgba(200,169,122,0.3);
        margin: 0.8rem auto;
        border-radius: 2px;
    }

    .footer .links { margin-top: 0.8rem; display: flex; gap: 1.5rem; justify-content: center; flex-wrap: wrap; }

    /* ── ANIMATIONS ── */
    .animate-in {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.5s ease;
    }

    .animate-in.visible {
        opacity: 1;
        transform: translateY(0);
    }

    /* ── RESPONSIVE ── */
    @media (max-width: 1100px) {
        .tari-grid { grid-template-columns: repeat(3, 1fr); gap: 16px; }
    }

    @media (max-width: 900px) {
        .hero-image { flex: 0 0 300px; }
        .kontak-info { grid-template-columns: repeat(5, 1fr); gap: 0.6rem; }
    }

    @media (max-width: 768px) {
        .container { padding: 0 1.2rem; }

        .logo-img { height: 36px; }

        .nav-links { display: none; }

        .burger-menu {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            width: 28px;
            height: 20px;
            cursor: pointer;
            z-index: 1002;
            padding: 0;
        }

        .burger-menu span {
            display: block;
            height: 2.5px;
            width: 100%;
            background-color: #5a3e2b;
            border-radius: 3px;
            transition: 0.3s ease;
        }

        .burger-menu.active span:nth-child(1) { transform: rotate(45deg) translate(5px, 6px); }
        .burger-menu.active span:nth-child(2) { opacity: 0; }
        .burger-menu.active span:nth-child(3) { transform: rotate(-45deg) translate(4px, -6px); }

        .mobile-drawer {
            display: flex;
            position: fixed;
            top: 0; right: -100%;
            width: min(320px, 85%);
            height: 100dvh;
            background: rgba(255,250,242,0.98);
            flex-direction: column;
            align-items: flex-start;
            justify-content: flex-start;
            padding: 5.5rem 1.5rem 2rem;
            gap: 0.15rem;
            transition: right 0.3s cubic-bezier(0.22, 1, 0.36, 1);
            z-index: 1001;
            border-left: 1px solid rgba(230,200,160,0.3);
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
        }

        .mobile-drawer.open { right: 0; }

        .mobile-drawer > a {
            text-decoration: none;
            color: #5a3e2b;
            font-weight: 600;
            font-size: 1.05rem;
            padding: 0.9rem 1rem;
            display: block;
            width: 100%;
            border-radius: 12px;
            transition: background 0.15s;
        }

        .mobile-drawer > a:active { background: rgba(139,90,43,0.1); }
        .mobile-drawer > a.active { background: rgba(139,90,43,0.08); color: var(--coklat-tua); }

        .mobile-drawer .dropdown { width: 100%; }
        .mobile-drawer .dropdown > a { width: 100%; padding: 0.9rem 1rem; font-size: 1.05rem; border-radius: 12px; }
        .mobile-drawer .dropdown-content {
            display: none;
            position: static;
            background: rgba(255,250,242,0.5);
            border-radius: 12px;
            margin: 2px 0.5rem 2px 1rem;
            box-shadow: none;
            border: 1px solid rgba(230,200,160,0.12);
            padding: 4px;
        }

        .mobile-drawer .dropdown.open .dropdown-content { display: block; }

        .mobile-drawer .dropdown-content a {
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
            border-radius: 8px;
        }

        .menu-overlay {
            display: block;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.35);
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: 0.25s;
            -webkit-tap-highlight-color: transparent;
        }

        .menu-overlay.active { opacity: 1; visibility: visible; }

        .hero {
            flex-direction: column;
            padding: 1.8rem 1.5rem;
            margin: 0.5rem 0 2rem;
            border-radius: 28px;
            gap: 1.5rem;
        }

        .hero-text h1 { font-size: 1.5rem; }
        .hero-text p { font-size: 0.88rem; margin-bottom: 1.2rem; }
        .hero-image { flex: none; width: 100%; max-width: 340px; margin: 0 auto; }
        .hero .btn { width: 100%; justify-content: center; padding: 0.9rem 1.5rem; font-size: 0.95rem; }

        .about-card { padding: 1.5rem; border-radius: 20px; }
        .about-content { flex-direction: column; }

        .layanan-tabs {
            width: 100%;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.4rem;
            padding: 6px;
            border-radius: 16px;
        }

        .layanan-tabs .tab-btn {
            flex: none;
            width: 100%;
            text-align: center;
            padding: 0.6rem 0.3rem;
            font-size: 0.78rem;
            border-radius: 20px;
        }

        .tari-grid { grid-template-columns: repeat(3, 1fr); gap: 12px; }

        .tari-card { border-radius: 16px; }

        .section-title { font-size: 1.45rem; }
        .section-subtitle { font-size: 0.85rem; }

        .kontak-card-section { padding: 1.2rem; border-radius: 18px; }
        .kontak-info { grid-template-columns: repeat(5, 1fr); gap: 0.4rem; margin-top: 1rem; }
        .kontak-link { padding: 0.7rem 0.3rem; border-radius: 10px; }
        .kontak-link::before { left: 6px; right: 6px; height: 3px; }
        .kontak-link .icon { font-size: 1.1rem; width: 1.1rem; height: 1.1rem; margin-bottom: 0.15rem; }
        .kontak-link h4 { font-size: 0.65rem; margin-bottom: 0.1rem; }
        .kontak-link p { font-size: 0.55rem; }
        .kontak-link .action { font-size: 0.55rem; margin-top: 2px; display: none; }

        .card-body { padding: 10px 12px; }
        .card-body h3 { font-size: 0.85rem; }
        .tari-desc { font-size: 0.68rem; -webkit-line-clamp: 1; }
        .ketersediaan-label { font-size: 0.62rem; padding: 3px 8px; }
        .aksesoris-title { font-size: 0.6rem; }
        .aksesoris-individual { padding: 6px; border-radius: 8px; }
        .aksesoris-item { font-size: 0.62rem; padding: 4px 6px; border-radius: 4px; }

        .footer { padding: 2rem 1.2rem; }
        .footer .brand { font-size: 1.1rem; }
        .footer .links { gap: 1rem; }
    }

    @media (max-width: 640px) {
        .tari-grid { grid-template-columns: repeat(2, 1fr); gap: 10px; }
        .card-body { padding: 10px 12px; }
        .card-body h3 { font-size: 0.82rem; margin-bottom: 6px; }
        .tari-desc { font-size: 0.68rem; -webkit-line-clamp: 1; margin-bottom: 8px; }
        .ketersediaan-label { font-size: 0.6rem; padding: 3px 8px; margin-bottom: 8px; }
        .aksesoris-title { font-size: 0.58rem; margin-bottom: 4px; }
        .aksesoris-individual { padding: 6px; border-radius: 8px; }
        .aksesoris-item { font-size: 0.6rem; padding: 4px 6px; }
        .tari-card { border-radius: 14px; }
        .image-container { aspect-ratio: 4/3; }
        .kontak-info { gap: 0.3rem; }
        .kontak-link { padding: 0.6rem 0.25rem; border-radius: 8px; }
        .kontak-link::before { left: 4px; right: 4px; }
        .kontak-link .icon { font-size: 1rem; width: 1rem; height: 1rem; }
        .kontak-link h4 { font-size: 0.6rem; }
        .kontak-link p { font-size: 0.5rem; }
        .kontak-link .action { display: none; }
    }

    @media (max-width: 480px) {
        .container { padding: 0 1rem; }

        .logo-img { height: 32px; }

        .hero { padding: 1.4rem 1.2rem; border-radius: 24px; gap: 1.2rem; }
        .hero-text h1 { font-size: 1.25rem; }
        .hero-text p { font-size: 0.82rem; }
        .hero-image { max-width: 280px; }

        .section-title { font-size: 1.3rem; }

        .layanan-tabs { grid-template-columns: repeat(3, 1fr); gap: 0.3rem; padding: 5px; border-radius: 14px; }
        .layanan-tabs .tab-btn { font-size: 0.72rem; padding: 0.5rem 0.2rem; }

        .tari-grid { grid-template-columns: repeat(2, 1fr); gap: 8px; max-width: 100%; margin: 0; }
        .card-body { padding: 6px 8px; }
        .card-body h3 { font-size: 0.72rem; }
        .tari-desc { font-size: 0.58rem; }
        .ketersediaan-label { font-size: 0.55rem; padding: 2px 5px; }
        .aksesoris-title { font-size: 0.52rem; }
        .aksesoris-item { font-size: 0.55rem; padding: 2px 4px; }
        .page-btn { font-size: 0.7rem; padding: 0.4rem 1rem; }
        .page-info { font-size: 0.7rem; }

        .about-card { padding: 1.2rem; border-radius: 16px; }

        .kontak-info { grid-template-columns: repeat(5, 1fr); gap: 0.3rem; }
        .kontak-link { padding: 0.55rem 0.2rem; border-radius: 8px; }
        .kontak-link::before { left: 4px; right: 4px; height: 2px; }
        .kontak-link .icon { font-size: 0.9rem; width: 0.9rem; height: 0.9rem; margin-bottom: 0.1rem; }
        .kontak-link h4 { font-size: 0.55rem; margin-bottom: 0.1rem; }
        .kontak-link p { font-size: 0.48rem; }
        .kontak-link .action { display: none; }

        .footer { padding: 1.8rem 1rem; }
    }

    @media (max-width: 400px) {
        .hero-text h1 { font-size: 1.1rem; }
        .hero-image { max-width: 240px; }
        .tari-grid { grid-template-columns: repeat(2, 1fr); gap: 6px; max-width: 100%; }
        .kontak-info { grid-template-columns: repeat(5, 1fr); gap: 0.2rem; }
        .kontak-link { padding: 0.5rem 0.15rem; border-radius: 6px; }
        .kontak-link::before { left: 3px; right: 3px; height: 2px; }
        .kontak-link .icon { font-size: 0.8rem; width: 0.8rem; height: 0.8rem; margin-bottom: 0.1rem; }
        .kontak-link h4 { font-size: 0.5rem; }
        .kontak-link p { display: none; }
        .section-title { font-size: 1.15rem; }
    }

    @media (max-width: 360px) {
        body { font-size: 14px; }
        .container { padding: 0 0.75rem; }
        .hero { padding: 1rem; border-radius: 18px; }
        .hero-text h1 { font-size: 1rem; }
        .about-card { padding: 1rem; border-radius: 14px; }
        .kontak-card-section { padding: 1rem; border-radius: 16px; }
        .global-search-box { max-width: 100%; }
        .global-search-box input { font-size: 0.85rem; padding: 12px 10px; }
        .gs-clear { font-size: 1.2rem; padding: 0 10px; }
    }


</style>
@endsection

@section('content')

{{-- NAVBAR --}}
<div class="header-wrapper" id="headerWrapper">
    <div class="container">
        <div class="navbar">
            <div class="logo" style="display:flex; align-items:center; gap:10px;">
                <a href="#beranda" style="text-decoration:none; font-family:'Playfair Display',serif; font-size:1.15rem; font-weight:700; color:#5a3e2b; display:flex; align-items:center; gap:10px;">
                    Sanggar Seni Nuansa Official
                    <img src="https://scontent.cdninstagram.com/v/t51.2885-19/317850763_1766169873754938_5686886054877064100_n.jpg?stp=dst-jpg_s150x150_tt6&_nc_cat=105&ccb=7-5&_nc_sid=f7ccc5&efg=eyJ2ZW5jb2RlX3RhZyI6InByb2ZpbGVfcGljLnd3dy4xMDgwLkMzIn0%3D&_nc_ohc=7XPJRBHzZ_AQ7kNvwFwTZSq&_nc_oc=Adq5iFipO6zYrVy-3107eEkmkQUois1VwUy2dnDPlXHt-7CwxvrKXpPoB45NkdpmMn4&_nc_zt=24&_nc_ht=scontent.cdninstagram.com&_nc_ss=7ba8c&oh=00_AQA1Rrbk8DZym6rLRqhNzYt6mVzSMa0stjPTZA7Yfl_M1w&oe=6A592F58" alt="Logo" style="width:40px; height:40px; border-radius:50%; object-fit:cover;">
                </a>
            </div>

            <div class="burger-menu" id="burgerMenu">
                <span></span><span></span><span></span>
            </div>

            <div class="nav-links" id="desktopNav">
                <a href="#beranda" data-section="beranda">Beranda</a>
                <div class="dropdown">
                    <a href="#layanan" data-section="layanan">Layanan</a>
                    <div class="dropdown-content">
                        <a href="#" data-tab="adat">🏛️ Kostum Adat</a>
                        <a href="#" data-tab="tari">💃 Kostum Tari</a>
                        <a href="#" data-tab="musik">🎵 Kostum Pemusik</a>
                    </div>
                </div>
                <a href="#kontak" data-section="kontak">Kontak</a>
            </div>
        </div>
    </div>
</div>

{{-- MOBILE DRAWER --}}
<div class="mobile-drawer" id="mobileDrawer">
    <a href="#beranda" data-section="beranda">Beranda</a>
    <div class="dropdown" id="mobileDropdown">
        <a href="#layanan" data-section="layanan">Layanan</a>
        <div class="dropdown-content">
            <a href="#" data-tab="adat">🏛️ Kostum Adat</a>
            <a href="#" data-tab="tari">💃 Kostum Tari</a>
            <a href="#" data-tab="musik">🎵 Kostum Pemusik</a>
        </div>
    </div>
    <a href="#kontak" data-section="kontak">Kontak</a>
</div>
<div class="menu-overlay" id="menuOverlay"></div>

<div class="container">

    {{-- HERO --}}
    <div id="beranda" class="hero">
        <div class="hero-text">
            <div class="badge">🇮🇩 Sanggar Seni & Rental Busana Nusantara</div>
            <h1>Busana Adat, Pendamping Budaya & Pertunjukan Seni</h1>
            <p>Nuansa Official menghadirkan pengalaman berkesan: sewa kebaya, beskap, songket, hingga pendamping yang paham adat istiadat.</p>
            <a href="#" class="btn" id="consultBtn">✨ Konsultasi Sekarang</a>
        </div>
        <div class="hero-image">
            <div class="img-wrap">
                <div class="img-placeholder" style="font-size:4rem; opacity:0.3; user-select:none;">🪅</div>
                <img src="https://placehold.co/500x400/eedbbc/8b5a2b?text=Nuansa+Official"
                     alt="Sanggar Seni Nuansa"
                     style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover; opacity:0;"
                     onload="this.style.opacity='1'; this.previousElementSibling.style.display='none';"
                     onerror="this.style.display='none'">
            </div>
        </div>
    </div>

    {{-- ABOUT --}}
    <section id="about">
        <div class="about-card">
            <div class="about-content">
                <div class="about-text">
                    <h2 class="section-title">Tentang Nuansa Official</h2>
                    <p>Sanggar Seni Nuansa Official adalah pusat layanan seni dan budaya yang menggabungkan <span class="highlight">rental busana adat berkualitas</span> dengan pendamping acara adat dan pertunjukan seni. Kami hadir untuk melestarikan wastra Nusantara.</p>
                    <p><strong>📍 Banjarmasin, Kalimantan Selatan</strong> — Melayani seluruh Indonesia.</p>
                    <p style="font-size:0.85rem; color:#b07c4f; font-weight:700;">#SeniNuansa #BanggaBusanaNusantara</p>
                </div>
            </div>
        </div>
    </section>

    {{-- LAYANAN --}}
    <section id="layanan">
        <h2 class="section-title">Layanan Unggulan</h2>
        <p class="section-subtitle">Jelajahi koleksi kostum Nusantara kami — dari adat hingga pertunjukan seni.</p>

        <div id="globalSearchWrap" class="global-search-wrap">
            <div class="global-search-box">
                <svg class="gs-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input type="text" id="globalSearchInput" placeholder="Cari busana, adat, tari..." autocomplete="off">
                <button id="globalSearchClear" class="gs-clear" style="display:none">&times;</button>
            </div>
        </div>

        <div class="layanan-tabs">
            <button class="tab-btn active" data-tab="adat">🏛️ Kostum Adat</button>
            <button class="tab-btn" data-tab="tari">💃 Kostum Tari</button>
            <button class="tab-btn" data-tab="musik">🎵 Kostum Pemusik</button>
        </div>

        @php
            function fallbackCard($item) {
                $g = $item['gambar'] ?? '';
                $k = $item['ketersediaan'] ?? 'tersedia';
                $lm = ['tersedia'=>'✅ Tersedia','disewa'=>'🔄 Disewa','tidak_tersedia'=>'❌ Tidak Tersedia'];
                $h = '<div class="tari-card" data-id="'.e($item['id']??'').'">
                    <div class="image-container">
                        <img src="'.e($g).'" class="costume-image" alt="'.e($item['nama']).'" loading="lazy"
                             onerror="this.src=\'data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22400%22 height=%22300%22 viewBox=%220 0 400 300%22%3E%3Crect fill=%22%23f0e6d6%22 width=%22400%22 height=%22300%22/%3E%3Ctext x=%22200%22 y=%22150%22 text-anchor=%22middle%22 dy=%22.3em%22 fill=%22%23b07c4f%22 font-size=%2248%22%3E'.e(mb_substr($item['nama'],0,1)).'%3C/text%3E%3C/svg%3E\'">
                    </div>
                    <div class="card-body">
                        <h3>'.e($item['nama']).'</h3>
                        <div class="tari-desc">'.e($item['deskripsi'] ?? '').'</div>
                        <div class="ketersediaan-label '.e($k).'">'.e($lm[$k] ?? '✅ Tersedia').'</div>
                        <div class="aksesoris-individual">
                            <div class="aksesoris-title">Aksesoris</div>
                            <div class="aksesoris-list-individual">';
                foreach ($item['aksesoris'] ?? [] as $a) {
                    $h .= '<div class="aksesoris-item"><span class="aksesoris-label">'.e($a['nama']).'</span></div>';
                }
                $h .= '</div></div></div></div>';
                return $h;
            }
            function fallbackGrid($items, $perPage = 6) {
                if (empty($items)) return '';
                $paginated = array_slice($items, 0, $perPage);
                $total = count($items);
                $totalHalaman = max(1, (int)ceil($total / $perPage));
                $h = '<div class="tari-grid">';
                foreach ($paginated as $item) { $h .= fallbackCard($item); }
                $h .= '</div>';
                $h .= '<div class="pagination-wrap">';
                $h .= '<span class="page-info">1/'.$totalHalaman.'</span>';
                if ($totalHalaman > 1) {
                    $h .= '<button class="page-btn">Selanjutnya &rsaquo;</button>';
                }
                $h .= '</div>';
                return $h;
            }
        @endphp
        <div id="adat" class="tab-content active">{!! fallbackGrid($data['adat'] ?? []) !!}</div>
        <div id="tari" class="tab-content">{!! fallbackGrid($data['tari'] ?? []) !!}</div>
        <div id="musik" class="tab-content">{!! fallbackGrid($data['musik'] ?? []) !!}</div>
    </section>

    {{-- KONTAK --}}
    <section id="kontak">
        <div class="kontak-card-section">
            <h2 class="section-title">Hubungi Kami</h2>
            <p class="section-subtitle" style="margin-bottom:0;">Pilih platform yang nyaman untuk Anda</p>
            <div class="kontak-info">
                <a href="https://wa.me/6285393398287" target="_blank" class="kontak-link whatsapp">
                    <div class="icon"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.82 11.82 0 00-3.48-8.413"/></svg></div>
                    <h4>WhatsApp</h4>
                    <p>0853-9339-8287</p>
                    <span class="action">Chat sekarang →</span>
                </a>
                <a href="https://www.instagram.com/sanggarseninuansaofficial/" target="_blank" class="kontak-link instagram">
                    <div class="icon"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg></div>
                    <h4>Instagram</h4>
                    <p>@sanggarseninuansaofficial</p>
                    <span class="action">Follow & DM →</span>
                </a>
                <a href="https://www.tiktok.com/@sanggarseninuansa" target="_blank" class="kontak-link tiktok">
                    <div class="icon"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg></div>
                    <h4>TikTok</h4>
                    <p>@sanggarseninuansa</p>
                    <span class="action">Lihat konten →</span>
                </a>
                <a href="mailto:rafiastiardi7@gmail.com" class="kontak-link email-card">
                    <div class="icon"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg></div>
                    <h4>Email</h4>
                    <p>rafiastiardi7@gmail.com</p>
                    <span class="action">Kirim email →</span>
                </a>
                <div class="kontak-link location">
                    <div class="icon"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg></div>
                    <h4>Lokasi Sanggar</h4>
                    <p>Kayu Tangi 2 jalur 2 no.18<br>Banjarmasin, Kalsel</p>
                </div>
            </div>
        </div>
    </section>

</div>

{{-- FOOTER --}}
<div class="footer">
    <div class="footer-inner">
        <div class="brand">Sanggar Seni Nuansa Official</div>
        <div class="divider"></div>
        <p>Banjarmasin, Kalimantan Selatan — Melayani seluruh Indonesia</p>
        <div class="links">
            <a href="#beranda">Beranda</a>
            <a href="#layanan">Layanan</a>

        </div>
        <p style="margin-top:0.8rem; font-size:0.78rem;">© 2024 Sanggar Seni Nuansa Official</p>
    </div>
</div>

@endsection

@section('scripts')
<script>
(function() {
    var kategoriData = @json($data);
    var PER_PAGE = 6;
    var curPage = { adat: 1, tari: 1, musik: 1 };
    var kategoriKeys = ['adat', 'tari', 'musik'];
    var kategoriLabels = { adat: '🏛️ Kostum Adat', tari: '💃 Kostum Tari', musik: '🎵 Kostum Pemusik' };
    var globalSearch = '';

    window.gantiHalaman = function(k, p) {
        curPage[k] = p;
        var container = document.getElementById(k);
        var gridTop = 0;
        if (container) {
            var grid = container.querySelector('.tari-grid');
            if (grid) gridTop = grid.getBoundingClientRect().top + window.pageYOffset - 10;
        }
        renderAll();
        window.scrollTo({ top: gridTop, behavior: 'smooth' });
    };

    function buildCardHtml(item) {
        var gambar = item.gambar || '';
        var ketersediaan = item.ketersediaan || 'tersedia';
        var labelMap = { tersedia: '✅ Tersedia', disewa: '🔄 Disewa', tidak_tersedia: '❌ Tidak Tersedia' };
        var safeNama = (item.nama || '').replace(/"/g, '&quot;').replace(/'/g, '&#39;');
        var safeDesc = (item.deskripsi || '').replace(/</g, '&lt;').replace(/>/g, '&gt;');
        var h = '<div class="tari-card" data-id="' + item.id + '">';
        h += '<div class="image-container">';
        h += '<img src="' + gambar + '" class="costume-image" alt="' + safeNama + '" loading="lazy">';
        h += '</div>';
        h += '<div class="card-body">';
        h += '<h3>' + safeNama + '</h3>';
        h += '<div class="tari-desc">' + safeDesc + '</div>';
        h += '<div class="ketersediaan-label ' + ketersediaan + '">' + (labelMap[ketersediaan] || '✅ Tersedia') + '</div>';
        h += '<div class="aksesoris-individual">';
        h += '<div class="aksesoris-title">Aksesoris</div>';
        h += '<div class="aksesoris-list-individual">';
        var accs = item.aksesoris || [];
        for (var i = 0; i < accs.length; i++) {
            h += '<div class="aksesoris-item"><span class="aksesoris-label">' + (accs[i].nama || '') + '</span></div>';
        }
        h += '</div></div></div></div>';
        return h;
    }

    function filterItems(list, term) {
        if (!term) return list;
        var t = term.toLowerCase();
        return list.filter(function(p) {
            return p.nama.toLowerCase().indexOf(t) !== -1 ||
                   (p.deskripsi || '').toLowerCase().indexOf(t) !== -1;
        });
    }

    function renderAll() {
        var term = globalSearch;
        var hasSearch = !!term;

        var clearBtn = document.getElementById('globalSearchClear');
        if (clearBtn) clearBtn.style.display = hasSearch ? '' : 'none';

        var tabsEl = document.querySelector('.layanan-tabs');

        if (hasSearch) {
            if (tabsEl) tabsEl.style.display = 'none';
            var allTabs = document.querySelectorAll('.tab-content');
            for (var t = 0; t < allTabs.length; t++) {
                allTabs[t].classList.remove('active');
                allTabs[t].style.display = 'none';
            }

            var total = 0;
            var sections = '';

            for (var i = 0; i < kategoriKeys.length; i++) {
                var key = kategoriKeys[i];
                var items = kategoriData[key] || [];
                var filtered = filterItems(items, term);
                if (filtered.length === 0) continue;
                total += filtered.length;
                sections += '<div class="search-section"><h3 class="search-section-title">' + kategoriLabels[key] + '</h3><div class="tari-grid">';
                for (var j = 0; j < filtered.length; j++) {
                    sections += buildCardHtml(filtered[j]);
                }
                sections += '</div></div>';
            }

            var container = document.getElementById('adat');
            if (container) {
                container.style.display = '';
                container.classList.add('active');
                if (total === 0) {
                    container.innerHTML = '<div class="search-info-global" style="margin-top:0;">🔍 Tidak ada busana untuk "' + term + '"</div>';
                } else {
                    container.innerHTML = '<div class="search-info-global">🔍 ' + total + ' hasil untuk "' + term + '"</div>' + sections;
                }
            }
        } else {
            if (tabsEl) tabsEl.style.display = '';
            var allTabs2 = document.querySelectorAll('.tab-content');
            for (var t2 = 0; t2 < allTabs2.length; t2++) {
                allTabs2[t2].style.display = '';
            }

            for (var k = 0; k < kategoriKeys.length; k++) {
                var key2 = kategoriKeys[k];
                var container2 = document.getElementById(key2);
                if (!container2) continue;
                var items2 = kategoriData[key2] || [];
                var totalHalaman = Math.max(1, Math.ceil(items2.length / PER_PAGE));
                var halaman = Math.min(curPage[key2] || 1, totalHalaman);
                curPage[key2] = halaman;
                var start = (halaman - 1) * PER_PAGE;
                var visible = items2.slice(start, start + PER_PAGE);

                var html = '<div class="tari-grid">';
                for (var m = 0; m < visible.length; m++) {
                    html += buildCardHtml(visible[m]);
                }
                html += '</div>';

                html += '<div class="pagination-wrap">';
                if (halaman > 1) {
                    html += '<button class="page-btn" onclick="gantiHalaman(\'' + key2 + '\', ' + (halaman - 1) + ')">‹ Kembali</button>';
                }
                html += '<span class="page-info">' + halaman + '/' + totalHalaman + '</span>';
                if (halaman < totalHalaman) {
                    html += '<button class="page-btn" onclick="gantiHalaman(\'' + key2 + '\', ' + (halaman + 1) + ')">Selanjutnya ›</button>';
                }
                html += '</div>';

                container2.innerHTML = html;
            }
        }
    }

    function switchTab(tabId) {
        if (globalSearch) {
            globalSearch = '';
            var inp = document.getElementById('globalSearchInput');
            if (inp) inp.value = '';
            var clr = document.getElementById('globalSearchClear');
            if (clr) clr.style.display = 'none';
        }
        var allTabs = document.querySelectorAll('.tab-content');
        for (var i = 0; i < allTabs.length; i++) allTabs[i].classList.remove('active');
        var target = document.getElementById(tabId);
        if (target) target.classList.add('active');
        var allBtns = document.querySelectorAll('.tab-btn');
        for (var j = 0; j < allBtns.length; j++) allBtns[j].classList.remove('active');
        var activeBtn = document.querySelector('.tab-btn[data-tab="' + tabId + '"]');
        if (activeBtn) activeBtn.classList.add('active');
        curPage[tabId] = 1;
        renderAll();
    }

    window.switchTab = switchTab;

    function init() {
        renderAll();

        var tabBtns = document.querySelectorAll('.tab-btn');
        for (var i = 0; i < tabBtns.length; i++) {
            (function(btn) {
                btn.addEventListener('click', function() { switchTab(btn.getAttribute('data-tab')); });
            })(tabBtns[i]);
        }

        var ddLinks = document.querySelectorAll('.dropdown-content a');
        for (var j = 0; j < ddLinks.length; j++) {
            (function(link) {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    switchTab(link.getAttribute('data-tab'));
                    var layanan = document.getElementById('layanan');
                    if (layanan) layanan.scrollIntoView({ behavior: 'smooth' });
                    var md = document.getElementById('mobileDrawer');
                    var ov = document.getElementById('menuOverlay');
                    var br = document.getElementById('burgerMenu');
                    if (md) md.classList.remove('open');
                    if (ov) ov.classList.remove('active');
                    if (br) br.classList.remove('active');
                    document.body.style.overflow = '';
                });
            })(ddLinks[j]);
        }

        var navLinks = document.querySelectorAll('.nav-links a[href^="#"], .mobile-drawer a[href^="#"]');
        for (var n = 0; n < navLinks.length; n++) {
            (function(anchor) {
                anchor.addEventListener('click', function(e) {
                    var href = this.getAttribute('href');
                    if (href && href !== '#') {
                        e.preventDefault();
                        var el = document.getElementById(href.substring(1));
                        if (el) el.scrollIntoView({ behavior: 'smooth' });
                    }
                });
            })(navLinks[n]);
        }

        var burger = document.getElementById('burgerMenu');
        var mobileDrawer = document.getElementById('mobileDrawer');
        var overlay = document.getElementById('menuOverlay');
        var mobileDropdown = document.getElementById('mobileDropdown');

        function openMobileMenu() {
            if (mobileDrawer) mobileDrawer.classList.add('open');
            if (overlay) overlay.classList.add('active');
            if (burger) burger.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
        function closeMobileMenu() {
            if (mobileDrawer) mobileDrawer.classList.remove('open');
            if (overlay) overlay.classList.remove('active');
            if (burger) burger.classList.remove('active');
            document.body.style.overflow = '';
            if (mobileDropdown) mobileDropdown.classList.remove('open');
        }

        if (burger) burger.addEventListener('click', function(e) {
            e.stopPropagation();
            if (mobileDrawer && mobileDrawer.classList.contains('open')) closeMobileMenu();
            else openMobileMenu();
        });
        if (overlay) overlay.addEventListener('click', closeMobileMenu);
        if (mobileDropdown) {
            var ddLink2 = mobileDropdown.querySelector('> a');
            if (ddLink2) ddLink2.addEventListener('click', function(e) {
                e.preventDefault();
                mobileDropdown.classList.toggle('open');
            });
        }

        var searchInput = document.getElementById('globalSearchInput');
        if (searchInput) searchInput.addEventListener('input', function() {
            globalSearch = this.value.trim();
            renderAll();
        });
        var searchClear = document.getElementById('globalSearchClear');
        if (searchClear) searchClear.addEventListener('click', function() {
            globalSearch = '';
            if (searchInput) searchInput.value = '';
            renderAll();
            if (searchInput) searchInput.focus();
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
</script>
@endsection
