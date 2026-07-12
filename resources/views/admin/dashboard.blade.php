@extends('layouts.app')

@section('title', 'Panel Admin - Sanggar Seni Nuansa')

@section('styles')
<style>
    body {
        background: linear-gradient(135deg, #fef9e6 0%, #f5ede0 100%);
        padding: 24px;
        min-height: 100vh;
    }

    .admin-container { max-width: 1440px; margin: 0 auto; }

    /* ── HEADER ── */
    .admin-header {
        background: rgba(255,255,255,0.92);
        backdrop-filter: blur(12px);
        border-radius: 20px;
        padding: 18px 28px;
        margin-bottom: 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 8px 24px rgba(139,90,43,0.06);
        border: 1px solid rgba(230,200,160,0.3);
    }

    .admin-header-left h1 {
        font-family: 'Playfair Display', serif;
        font-size: 1.35rem;
        color: var(--coklat-tua);
        letter-spacing: -0.3px;
    }

    .admin-header-left h1 span {
        display: inline-block;
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, var(--coklat-tua), var(--coklat-muda));
        border-radius: 10px;
        text-align: center;
        line-height: 36px;
        font-size: 1rem;
        margin-right: 8px;
        vertical-align: middle;
    }

    .admin-header-left p {
        font-size: 0.8rem;
        color: var(--coklat-muda);
        margin-top: 2px;
        font-weight: 500;
    }

    .admin-header-left p span.user-name {
        font-weight: 700;
        color: var(--coklat-tua);
    }

    .header-actions {
        display: flex;
        gap: 10px;
        align-items: center;
        flex-wrap: wrap;
    }

    .btn-header {
        padding: 10px 22px;
        border-radius: 40px;
        font-weight: 700;
        font-size: 0.82rem;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        font-family: 'Nunito', sans-serif;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-beranda {
        background: var(--krem);
        color: var(--coklat-tua);
        border: 1.5px solid var(--border);
    }
    .btn-beranda:hover {
        background: var(--emas);
        border-color: var(--emas);
        color: #5a3e2b;
        transform: translateY(-1px);
    }

    .btn-logout {
        background: #e76f51;
        color: white;
    }
    .btn-logout:hover {
        background: #d9573f;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(231,111,81,0.35);
    }

    /* Dropdown Menu Admin */
    .admin-dropdown {
        position: relative;
        display: inline-block;
    }

    .admin-dropdown-toggle {
        padding: 10px 22px;
        border-radius: 40px;
        font-weight: 700;
        font-size: 0.82rem;
        text-decoration: none;
        border: 1.5px solid var(--border);
        cursor: pointer;
        font-family: 'Nunito', sans-serif;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--krem);
        color: var(--coklat-tua);
        transition: all 0.2s;
        user-select: none;
    }

    .admin-dropdown-toggle:hover {
        background: var(--emas);
        border-color: var(--emas);
    }

    .admin-dropdown-menu {
        display: none;
        position: absolute;
        top: calc(100% + 6px);
        right: 0;
        background: white;
        border-radius: 14px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.12);
        border: 1px solid rgba(230,200,160,0.3);
        min-width: 180px;
        z-index: 100;
        overflow: hidden;
        padding: 6px;
    }

    .admin-dropdown.open .admin-dropdown-menu {
        display: block;
    }

    .admin-dropdown-menu a,
    .admin-dropdown-menu button {
        display: flex;
        align-items: center;
        gap: 8px;
        width: 100%;
        padding: 10px 14px;
        border: none;
        background: none;
        color: #5a3e2b;
        font-weight: 600;
        font-size: 0.82rem;
        font-family: 'Nunito', sans-serif;
        text-decoration: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background 0.15s;
        text-align: left;
    }

    .admin-dropdown-menu a:hover,
    .admin-dropdown-menu button:hover {
        background: #f3e8d5;
    }

    .admin-dropdown-menu form {
        display: contents;
    }

    .admin-dropdown-menu .menu-logout {
        color: #e76f51;
    }

    .admin-dropdown-menu .menu-logout:hover {
        background: #fde8e4;
    }

    /* ── STATS ── */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }

    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 18px 16px;
        text-align: center;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 4px 12px rgba(0,0,0,0.04);
        transition: all 0.25s ease;
        border: 1px solid rgba(230,200,160,0.2);
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--coklat-tua), var(--emas));
        opacity: 0.6;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(139,90,43,0.1);
    }

    .stat-card .icon-wrap {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 10px;
        font-size: 1.2rem;
    }

    .stat-card:nth-child(1) .icon-wrap { background: #fef3e2; }
    .stat-card:nth-child(2) .icon-wrap { background: #ffecd2; }
    .stat-card:nth-child(3) .icon-wrap { background: #e8f0fe; }
    .stat-card:nth-child(4) .icon-wrap { background: #fce4ec; }
    .stat-card:nth-child(5) .icon-wrap { background: #e8f5e9; }

    .stat-num {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--coklat-tua);
        line-height: 1.1;
    }

    .stat-label {
        font-size: 0.72rem;
        color: #b07c4f;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-top: 4px;
    }

    /* ── FORM ── */
    .form-card {
        background: white;
        border-radius: 20px;
        padding: 28px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 8px 24px rgba(0,0,0,0.05);
        border: 1px solid rgba(230,200,160,0.2);
        position: sticky;
        top: 24px;
    }

    .form-card h2 {
        font-family: 'Playfair Display', serif;
        color: var(--coklat-tua);
        margin-bottom: 22px;
        font-size: 1.15rem;
        padding-bottom: 14px;
        border-bottom: 2px solid #f3e8d5;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-card h2::before {
        content: '';
        width: 4px;
        height: 22px;
        background: linear-gradient(180deg, var(--coklat-tua), var(--emas));
        border-radius: 4px;
    }

    .form-group { margin-bottom: 16px; }

    .form-group label {
        display: block;
        font-weight: 700;
        font-size: 0.8rem;
        color: #5a3e2b;
        margin-bottom: 5px;
        letter-spacing: 0.3px;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 11px 14px;
        border: 1.5px solid #e6d5bb;
        border-radius: 12px;
        font-family: 'Nunito', sans-serif;
        font-size: 0.88rem;
        color: #3e2a1f;
        background: #fdfaf5;
        outline: none;
        transition: all 0.2s;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: var(--coklat-tua);
        box-shadow: 0 0 0 3px rgba(139,90,43,0.1);
        background: white;
    }

    .form-group textarea { resize: vertical; min-height: 70px; }

    .helper-text {
        font-size: 0.68rem;
        color: #b87c4f;
        margin-top: 4px;
        font-weight: 500;
    }

    .gambar-opsi {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .gambar-input {
        flex: 1;
        display: flex;
        align-items: center;
        gap: 6px;
        background: #fdfaf5;
        border: 1.5px solid #e6d5bb;
        border-radius: 10px;
        padding: 2px 4px 2px 10px;
        transition: border-color 0.2s;
    }
    .gambar-input:focus-within { border-color: var(--coklat-tua); }

    .gambar-label {
        font-size: 0.7rem;
        font-weight: 700;
        color: #b07c4f;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        flex-shrink: 0;
    }

    .gambar-input input[type="text"],
    .gambar-input input[type="file"] {
        border: none;
        background: transparent;
        padding: 8px 6px;
        font-family: 'Nunito', sans-serif;
        font-size: 0.82rem;
        outline: none;
        flex: 1;
        min-width: 0;
    }
    .gambar-input input[type="file"] { font-size: 0.75rem; }

    .gambar-divider {
        font-size: 0.72rem;
        font-weight: 700;
        color: #c0a888;
        flex-shrink: 0;
        padding: 0 2px;
    }

    .img-preview {
        margin-top: 10px;
        text-align: center;
        background: #fdfaf5;
        border-radius: 10px;
        padding: 8px;
        border: 1px dashed var(--border);
    }
    .img-preview img {
        max-width: 140px;
        max-height: 100px;
        border-radius: 8px;
        object-fit: cover;
    }

    /* Aksesoris */
    .aksesoris-section {
        background: #fdfaf5;
        border-radius: 14px;
        padding: 16px;
        margin-bottom: 16px;
        border: 1px solid #e9dcc5;
    }

    .aksesoris-section h4 {
        font-size: 0.8rem;
        font-weight: 700;
        color: var(--coklat-tua);
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .acc-row {
        display: grid;
        grid-template-columns: 1fr 34px;
        gap: 8px;
        margin-bottom: 8px;
        align-items: center;
    }

    .acc-row input {
        width: 100%;
        padding: 10px 12px;
        border: 1.5px solid #e6d5bb;
        border-radius: 10px;
        font-family: 'Nunito', sans-serif;
        font-size: 0.88rem;
        color: #3e2a1f;
        background: #fdfaf5;
        outline: none;
        transition: border-color 0.2s;
        box-sizing: border-box;
    }
    .acc-row input:focus { border-color: #8b5a2b; box-shadow: 0 0 0 3px rgba(139,90,43,0.1); background: white; }

    .btn-remove-acc {
        background: #e76f51;
        color: white;
        border: none;
        border-radius: 50%;
        width: 32px;
        height: 32px;
        cursor: pointer;
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.2s;
        flex-shrink: 0;
    }
    .btn-remove-acc:hover { background: #d9573f; transform: scale(1.05); }

    .btn-add-acc {
        background: var(--hijau);
        color: white;
        border: none;
        padding: 8px 18px;
        border-radius: 20px;
        cursor: pointer;
        font-size: 0.78rem;
        font-weight: 700;
        font-family: 'Nunito', sans-serif;
        transition: 0.2s;
    }
    .btn-add-acc:hover { background: #1a3c1e; }

    .btn-submit {
        width: 100%;
        padding: 14px;
        background: linear-gradient(135deg, var(--coklat-tua), var(--coklat-muda));
        color: white;
        border: none;
        border-radius: 40px;
        font-family: 'Nunito', sans-serif;
        font-size: 0.95rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.25s;
        margin-top: 4px;
        box-shadow: 0 6px 20px rgba(139,90,43,0.25);
        letter-spacing: 0.3px;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 28px rgba(139,90,43,0.35);
    }

    /* ── TABLE ── */
    .list-card {
        background: white;
        border-radius: 20px;
        padding: 24px 24px 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 8px 24px rgba(0,0,0,0.05);
        border: 1px solid rgba(230,200,160,0.2);
    }

    .list-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 16px;
        padding-bottom: 14px;
        border-bottom: 2px solid #f3e8d5;
    }

    .list-card-header h2 {
        font-family: 'Playfair Display', serif;
        color: var(--coklat-tua);
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .list-card-header .header-right {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-tambah-baju {
        padding: 8px 18px;
        border: none;
        border-radius: 8px;
        background: #e4f0e4;
        color: #1a5c1a;
        font-weight: 700;
        font-size: 0.78rem;
        cursor: pointer;
        font-family: 'Nunito', sans-serif;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .btn-tambah-baju:hover { background: #c8e0c8; }
    .btn-tambah-baju.active { background: #d4e8d4; }

    .form-collapse {
        display: none;
        margin-bottom: 20px;
        padding: 20px;
        background: #fdfaf5;
        border-radius: 14px;
        border: 1px solid #e8dcc8;
    }
    .form-collapse.open { display: block; }

    .form-row-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .btn-delete-all {
        padding: 8px 18px;
        border: none;
        border-radius: 8px;
        background: #fde8e4;
        color: #b33a2a;
        font-weight: 700;
        font-size: 0.78rem;
        cursor: pointer;
        font-family: 'Nunito', sans-serif;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border: 1px solid #f5c8c0;
    }
    .btn-delete-all:hover {
        background: #b33a2a;
        color: white;
        border-color: #b33a2a;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(179,58,42,0.25);
    }

    /* Filter + search */
    .filter-bar {
        display: flex;
        flex-wrap: nowrap;
        gap: 5px;
        margin-bottom: 14px;
        align-items: center;
    }

    .cat-btn {
        padding: 5px 14px;
        border: 1.5px solid #e6d5bb;
        border-radius: 7px;
        font-weight: 700;
        font-size: 0.75rem;
        cursor: pointer;
        background: white;
        color: #7a5a3a;
        font-family: 'Nunito', sans-serif;
        transition: all 0.15s;
        text-decoration: none;
        line-height: 1.4;
    }

    .cat-btn:hover {
        border-color: var(--coklat-tua);
        background: #fdf8f0;
        color: var(--coklat-tua);
    }

    .cat-btn.active {
        background: var(--coklat-tua);
        color: white;
        border-color: var(--coklat-tua);
    }

    .search-form {
        display: flex;
        gap: 5px;
        margin-left: auto;
    }

    .search-form input {
        padding: 6px 12px;
        border: 1.5px solid #e6d5bb;
        border-radius: 7px;
        font-family: 'Nunito', sans-serif;
        font-size: 0.8rem;
        outline: none;
        width: 180px;
        background: #fdfaf5;
        transition: 0.15s;
    }

    .search-form input:focus {
        border-color: var(--coklat-tua);
        background: white;
        box-shadow: 0 0 0 3px rgba(139,90,43,0.08);
    }

    .search-form button {
        padding: 6px 16px;
        background: var(--coklat-tua);
        color: white;
        border: none;
        border-radius: 7px;
        cursor: pointer;
        font-family: 'Nunito', sans-serif;
        font-weight: 700;
        font-size: 0.78rem;
        transition: 0.15s;
    }
    .search-form button:hover { background: var(--coklat-muda); }

    /* Table */
    .table-wrap {
        overflow-x: auto;
        border-radius: 12px;
        border: 1px solid #ede3d0;
        background: white;
    }

    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        font-size: 0.85rem;
    }

    thead th {
        background: #f8f2e8;
        color: #4a3520;
        padding: 10px 10px;
        text-align: left;
        font-weight: 700;
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e0cfb5;
        position: sticky;
        top: 0;
        z-index: 2;
        white-space: nowrap;
    }
    thead th:first-child { border-radius: 12px 0 0 0; width: 52px; }
    thead th:last-child  { border-radius: 0 12px 0 0; width: 110px; }
    thead th:nth-child(2) { width: 100px; }
    thead th:nth-child(4) { width: 140px; }
    thead th:nth-child(5) { width: 100px; }
    thead th:nth-child(6) { width: 140px; }
    thead th:nth-child(7) { width: 72px; text-align: center; }

    tbody td {
        padding: 9px 10px;
        border-bottom: 1px solid #f0e6d8;
        vertical-align: middle;
    }
    tbody tr:last-child td { border-bottom: none; }
    tbody tr:last-child td:first-child { border-radius: 0 0 0 12px; }
    tbody tr:last-child td:last-child  { border-radius: 0 0 12px 0; }

    tbody tr { transition: background 0.12s; }
    tbody tr:hover td { background: #faf5ed; }
    tbody tr:nth-child(even) td { background: #fcf9f4; }
    tbody tr:nth-child(even):hover td { background: #faf5ed; }

    .cell-nama {
        font-weight: 600;
        color: #2c1f12;
        font-size: 0.82rem;
        white-space: nowrap;
    }

    .-desc {
        color: #a08060;
        font-size: 0.7rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        line-height: 1.3;
    }

    .cell-ketersediaan {
        font-weight: 700;
        color: #4a3520;
        font-size: 0.8rem;
        white-space: nowrap;
    }

    .ketersediaan-badge {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 0.68rem;
        font-weight: 700;
        white-space: nowrap;
    }
    .ketersediaan-tersedia { background: #e8f5e9; color: #2e7d32; }
    .ketersediaan-disewa   { background: #fff3e0; color: #e65100; }
    .ketersediaan-tidak    { background: #ffebee; color: #c62828; }

    .thumb {
        width: 38px;
        height: 38px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #e6d5bb;
        display: block;
    }

    .badge-kat {
        padding: 2px 8px;
        border-radius: 5px;
        font-size: 0.65rem;
        font-weight: 700;
        display: inline-block;
        white-space: nowrap;
    }

    .kat-adat        { background: #e8f0fe; color: #2563eb; }
    .kat-tari        { background: #fde8ee; color: #c2185b; }
    .kat-musik       { background: #e6f3e6; color: #2c5a2e; }

    .kategori-checkbox-group {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 6px;
    }
    .kategori-checkbox {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        font-size: 0.85rem;
        cursor: pointer;
        background: transparent;
        padding: 6px 4px;
        border-radius: 6px;
        transition: 0.15s;
        white-space: nowrap;
    }
    .kategori-checkbox:hover { background: #f5f0e8; }
    .kategori-checkbox input[type="checkbox"] { width: 16px; height: 16px; accent-color: #8b5a2b; flex-shrink: 0; margin: 0; }

    .status-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 3px;
        padding: 2px 8px;
        border-radius: 5px;
        font-size: 0.62rem;
        font-weight: 700;
        white-space: nowrap;
        min-width: 54px;
    }
    .status-badge.aktif {
        background: #e6f3e6;
        color: #1f4a20;
    }
    .status-badge.nonaktif {
        background: #fde8e4;
        color: #b33a2a;
    }

    .cell-acc {
        font-size: 0.7rem;
        color: #5a4530;
        max-width: 140px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .cell-acc:hover {
        overflow: visible;
        white-space: normal;
        word-break: break-word;
        position: relative;
        background: #fdfaf5;
        padding: 4px 8px;
        margin: -4px -8px;
        border-radius: 6px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        z-index: 3;
    }
    .cell-acc .empty-val { color: #d0c0a8; }

    .actions {
        display: flex;
        gap: 4px;
        flex-wrap: nowrap;
    }

    .btn-edit, .btn-del {
        padding: 4px 9px;
        border: none;
        border-radius: 5px;
        font-weight: 700;
        font-size: 0.65rem;
        cursor: pointer;
        font-family: 'Nunito', sans-serif;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 3px;
        transition: all 0.15s;
        line-height: 1.4;
        white-space: nowrap;
    }

    .btn-edit {
        background: #fef0e0;
        color: #b87530;
        border: 1px solid #f5d6b0;
    }
    .btn-edit:hover {
        background: #b87530;
        color: white;
        border-color: #b87530;
    }

    .btn-del {
        background: #fde8e4;
        color: #b33a2a;
        border: 1px solid #f5c8c0;
    }
    .btn-del:hover {
        background: #b33a2a;
        color: white;
        border-color: #b33a2a;
    }

    .empty-state {
        text-align: center;
        padding: 48px 20px;
    }
    .empty-icon {
        font-size: 2.4rem;
        margin-bottom: 12px;
        opacity: 0.6;
    }
    .empty-text {
        font-size: 1rem;
        font-weight: 700;
        color: #4a3520;
        margin-bottom: 4px;
    }
    .empty-sub {
        font-size: 0.78rem;
        color: #b09878;
    }

    /* Pagination Info */
    .pagination-info {
        text-align: center;
        margin-top: 16px;
        font-size: 0.82rem;
        color: #b07c4f;
        font-weight: 600;
        padding: 8px 0;
    }

    /* ── ANIMATIONS ── */
    .admin-header, .stat-card, .form-card, .list-card {
        animation: fadeUp 0.4s ease both;
    }
    .stat-card:nth-child(1) { animation-delay: 0.05s; }
    .stat-card:nth-child(2) { animation-delay: 0.1s; }
    .stat-card:nth-child(3) { animation-delay: 0.15s; }
    .stat-card:nth-child(4) { animation-delay: 0.2s; }
    .stat-card:nth-child(5) { animation-delay: 0.25s; }
    .form-card { animation-delay: 0.1s; }
    .list-card { animation-delay: 0.15s; }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* ── MOBILE TAB NAV ── */
    .mobile-admin-nav, .mobile-section { display: none; }

    @media (max-width: 767px) {
        .mobile-admin-nav {
            display: flex;
            gap: 4px;
            margin-bottom: 16px;
            background: white;
            border-radius: 14px;
            padding: 4px;
            border: 1px solid rgba(230,200,160,0.2);
            box-shadow: 0 1px 3px rgba(0,0,0,0.03);
        }

        .mobile-admin-nav button {
            flex: 1;
            padding: 10px 8px;
            border: none;
            border-radius: 10px;
            font-family: 'Nunito', sans-serif;
            font-size: 0.82rem;
            font-weight: 700;
            cursor: pointer;
            background: transparent;
            color: #7a5a3a;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .mobile-admin-nav button.active {
            background: var(--coklat-tua);
            color: white;
            box-shadow: 0 2px 8px rgba(139,90,43,0.2);
        }

        .mobile-section { display: block; }
        .desktop-layout { display: none; }

        .form-card, .list-card {
            display: none;
            animation: fadeIn 0.25s ease;
        }

        .form-card.visible, .list-card.visible,
        .mobile-section.visible .form-card,
        .mobile-section.visible .list-card {
            display: block;
        }

        .mobile-section .kategori-checkbox-group { grid-template-columns: 1fr; gap: 4px; }
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(8px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* ── RESPONSIVE ── */
    @media (max-width: 1200px) {
        .admin-grid { grid-template-columns: 1fr; }
        .form-card { position: static; }
    }

    @media (max-width: 900px) {
        .stats-row { grid-template-columns: repeat(3, 1fr); }
        .admin-header-left p { display: none; }
        .admin-header { flex-wrap: nowrap; }
        .form-row-2 { grid-template-columns: 1fr; }
    }

    @media (max-width: 640px) {
        body { padding: 12px; }
        .stats-row { grid-template-columns: repeat(4, 1fr); gap: 6px; }
        .search-form { margin-left: 0; width: 100%; }
        .search-form input { flex: 1; min-width: 0; }
        .admin-header { padding: 12px 16px; border-radius: 14px; flex-wrap: nowrap; gap: 8px; }
        .header-actions { flex: 1; justify-content: flex-end; }
        .admin-header-left h1 { font-size: 1rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .admin-header-left h1 span { width: 30px; height: 30px; line-height: 30px; font-size: 0.85rem; }
        .admin-header-left p { display: none; }
        .stat-card { padding: 12px 6px; border-radius: 12px; }
        .stat-card .icon-wrap { width: 30px; height: 30px; font-size: 0.85rem; margin-bottom: 4px; }
        .stat-num { font-size: 1.1rem; }
        .stat-label { font-size: 0.6rem; }
        .form-card, .list-card { padding: 16px; border-radius: 14px; }
        .form-card h2 { font-size: 1rem; }
        .gambar-opsi { flex-direction: column; gap: 6px; }
        .gambar-divider { font-size: 0.65rem; }
        .list-card-header { flex-direction: column; align-items: stretch; gap: 8px; }
        .list-card-header h2 { font-size: 1rem; }
        .btn-delete-all { align-self: flex-end; }
        .filter-bar { gap: 4px; flex-wrap: nowrap; overflow-x: auto; padding-bottom: 4px; }
        .cat-btn { padding: 5px 10px; font-size: 0.68rem; border-radius: 6px; flex-shrink: 0; }
        #section-tambah .kategori-checkbox-group { grid-template-columns: 1fr; gap: 4px; }
        .search-form { margin-left: 0; width: 100%; }
        .search-form input { width: 100%; }
        .search-form button { padding: 7px 12px; font-size: 0.75rem; flex-shrink: 0; }
        .table-wrap { border-radius: 8px; overflow-x: auto; }
        thead th { padding: 7px 6px; font-size: 0.6rem; letter-spacing: 0.3px; }
        tbody td { padding: 7px 6px; }
        thead th:first-child { width: 42px; }
        thead th:last-child { width: 100px; }
        thead th:nth-child(2) { width: 82px; }
        thead th:nth-child(4) { width: 120px; }
        thead th:nth-child(5) { width: 82px; }
        thead th:nth-child(6) { width: 110px; }
        thead th:nth-child(7) { width: 62px; }
        .thumb { width: 30px; height: 30px; border-radius: 5px; }
        .badge-kat { padding: 2px 6px; font-size: 0.58rem; border-radius: 4px; }
        .cell-nama { font-size: 0.75rem; }
        .cell-ketersediaan { font-size: 0.72rem; }
        .-desc { font-size: 0.65rem; -webkit-line-clamp: 1; }
        .cell-acc { font-size: 0.65rem; max-width: 90px; }
        .status-badge { padding: 2px 6px; font-size: 0.58rem; border-radius: 4px; min-width: 48px; }
        .btn-edit, .btn-del { padding: 3px 7px; font-size: 0.62rem; border-radius: 4px; }
        .btn-delete-all { padding: 6px 14px; font-size: 0.72rem; border-radius: 6px; }
        .pagination-info { font-size: 0.75rem; margin-top: 12px; }
        .empty-state { padding: 32px 16px; }
        .empty-icon { font-size: 2rem; }
        .empty-text { font-size: 0.9rem; }
        .empty-sub { font-size: 0.72rem; }
    }

    @media (max-width: 480px) {
        body { padding: 10px; }
        .stats-row { grid-template-columns: repeat(4, 1fr); gap: 4px; }
        .admin-header { padding: 10px 14px; border-radius: 12px; flex-wrap: nowrap; }
        .admin-header-left h1 { font-size: 0.9rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .admin-header-left h1 span { width: 26px; height: 26px; line-height: 26px; font-size: 0.75rem; }
        .btn-header { padding: 8px 14px; font-size: 0.75rem; }
        .form-card, .list-card { padding: 12px; border-radius: 12px; }
        .form-card h2 { font-size: 0.95rem; }
        .list-card-header h2 { font-size: 0.95rem; }
        .form-group { margin-bottom: 12px; }
        .form-group input, .form-group select, .form-group textarea { padding: 9px 12px; font-size: 0.82rem; }
        .acc-row { grid-template-columns: 1fr 30px; gap: 4px; }
        .btn-add-acc { padding: 6px 14px; font-size: 0.72rem; }
        .btn-submit { padding: 12px; font-size: 0.85rem; }
        thead th { padding: 6px 4px; font-size: 0.55rem; }
        tbody td { padding: 6px 4px; }
        thead th:first-child { width: 36px; }
        thead th:nth-child(4) { display: none; }
        tbody td:nth-child(4) { display: none; }
        thead th:nth-child(5) { width: 72px; }
        thead th:nth-child(6) { width: 90px; }
        .thumb { width: 26px; height: 26px; border-radius: 4px; }
        .cell-nama { font-size: 0.72rem; }
        .cell-ketersediaan { font-size: 0.7rem; }
        .cell-acc { max-width: 70px; font-size: 0.62rem; }
        .cat-btn { padding: 4px 8px; font-size: 0.62rem; }
        .search-form input { font-size: 0.78rem; padding: 6px 10px; }
        .search-form button { padding: 6px 10px; font-size: 0.72rem; }
        .pagination-wrap { margin-top: 14px; }
        .pagination-wrap .page-item .page-link { padding: 5px 8px; font-size: 0.65rem; }
    }

    @media (max-width: 380px) {
        .stats-row { grid-template-columns: repeat(4, 1fr); gap: 3px; }
        .stat-card { padding: 8px 6px; }
        .stat-num { font-size: 1.1rem; }
        .filter-bar { flex-wrap: wrap; }
        .cat-btn { text-align: center; }
        .search-form { flex-direction: column; }
        .search-form input { width: 100%; }
        .search-form button { width: 100%; }
        thead th:nth-child(5) { display: none; }
        tbody td:nth-child(5) { display: none; }
        thead th:nth-child(7) { display: none; }
        tbody td:nth-child(7) { display: none; }
    }
</style>
@endsection

@section('content')
<div class="admin-container">

    {{-- HEADER --}}
    <div class="admin-header">
        <div class="admin-header-left">
            <h1><span>👑</span>Panel Admin</h1>
            <p>Selamat datang, {{ Auth::guard('admin')->user()->name }} · Sanggar Seni Nuansa</p>
        </div>
        <div class="header-actions">
            <div class="admin-dropdown" id="adminDropdown">
                <div class="admin-dropdown-toggle" onclick="document.getElementById('adminDropdown').classList.toggle('open')">
                    ⚙️ Menu ▾
                </div>
                <div class="admin-dropdown-menu">
                    <a href="{{ route('penyewa.index') }}" target="_blank">🏠 Lihat Beranda</a>
                    <form method="POST" action="{{ route('admin.logout') }}" style="margin:0">
                        @csrf
                        <button type="submit" class="menu-logout">🚪 Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- MOBILE NAV --}}
    <div class="mobile-admin-nav">
        <button data-section="daftar" class="active">📋 Daftar Busana</button>
        <button data-section="tambah">➕ Tambah Baju</button>
    </div>

    {{-- MOBILE SECTION: DAFTAR (stats + tabel) --}}
    <div class="mobile-section visible" id="section-daftar">

        <div class="stats-row">
            <div class="stat-card">
                <div class="icon-wrap">📦</div>
                <div class="stat-num">{{ $stats['total'] }}</div>
                <div class="stat-label">Total Busana</div>
            </div>
            <div class="stat-card">
                <div class="icon-wrap">🏛️</div>
                <div class="stat-num">{{ $stats['adat'] }}</div>
                <div class="stat-label">Kostum Adat</div>
            </div>
            <div class="stat-card">
                <div class="icon-wrap">💃</div>
                <div class="stat-num">{{ $stats['tari'] }}</div>
                <div class="stat-label">Kostum Tari</div>
            </div>
            <div class="stat-card">
                <div class="icon-wrap">🎵</div>
                <div class="stat-num">{{ $stats['musik'] }}</div>
                <div class="stat-label">Kostum Pemusik</div>
            </div>
        </div>

        <div class="list-card">
            <div class="list-card-header">
                <h2>📋 Daftar Busana</h2>
                <div class="header-right">
                    <form method="GET" action="{{ route('admin.dashboard') }}" class="search-form">
                        <input type="hidden" name="kategori" value="{{ $kategori }}">
                        <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama/deskripsi...">
                        <button type="submit">Cari</button>
                    </form>
                </div>
            </div>

            <div class="filter-bar">
                <a href="{{ route('admin.dashboard', ['kategori' => 'all', 'search' => $search]) }}"
                   class="cat-btn {{ $kategori === 'all' ? 'active' : '' }}">Semua</a>
                <a href="{{ route('admin.dashboard', ['kategori' => 'adat', 'search' => $search]) }}"
                   class="cat-btn {{ $kategori === 'adat' ? 'active' : '' }}">🏛️ Kostum Adat</a>
                <a href="{{ route('admin.dashboard', ['kategori' => 'tari', 'search' => $search]) }}"
                   class="cat-btn {{ $kategori === 'tari' ? 'active' : '' }}">💃 Kostum Tari</a>
                <a href="{{ route('admin.dashboard', ['kategori' => 'musik', 'search' => $search]) }}"
                   class="cat-btn {{ $kategori === 'musik' ? 'active' : '' }}">🎵 Kostum Pemusik</a>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Kategori</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Ketersediaan</th>
                            <th>Aksesoris</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bajus as $baju)
                        <tr>
                            <td>
                                <img src="{{ $baju->gambar_url }}" class="thumb"
                                     onerror="this.src='https://placehold.co/44x44/f7ebda/8b5a2b?text=?'"
                                     alt="{{ $baju->nama }}">
                            </td>
                            <td>
                                @foreach((array)$baju->kategori as $kat)
                                <span class="badge-kat kat-{{ $kat }}">{{ ['adat'=>'Kostum Adat','tari'=>'Kostum Tari','musik'=>'Kostum Pemusik'][$kat] ?? $kat }}</span>
                                @endforeach
                            </td>
                            <td class="cell-nama">{{ $baju->nama }}</td>
                            <td>
                                @if($baju->deskripsi)
                                <span class="-desc">{{ Str::limit($baju->deskripsi, 60) }}</span>
                                @else
                                <span class="-desc" style="color:#d0c0a8">—</span>
                                @endif
                            </td>
                            <td class="cell-ketersediaan">
                                @if($baju->ketersediaan === 'tersedia')
                                    <span class="ketersediaan-badge ketersediaan-tersedia">✅ Tersedia</span>
                                @elseif($baju->ketersediaan === 'disewa')
                                    <span class="ketersediaan-badge ketersediaan-disewa">🔄 Disewa</span>
                                @else
                                    <span class="ketersediaan-badge ketersediaan-tidak">❌ Tidak Tersedia</span>
                                @endif
                            </td>
                            <td class="cell-acc">
                                @if($baju->aksesoris->count())
                                    <span title="{{ $baju->aksesoris->pluck('nama')->join(', ') }}">
                                    {{ $baju->aksesoris->pluck('nama')->join(', ') }}
                                    </span>
                                @else
                                    <span class="empty-val">—</span>
                                @endif
                            </td>
                            <td style="text-align:center">
                                @if($baju->aktif)
                                    <span class="status-badge aktif">● Aktif</span>
                                @else
                                    <span class="status-badge nonaktif">○ Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('admin.baju.edit', $baju) }}" class="btn-edit">Edit</a>
                                    <form method="POST" action="{{ route('admin.baju.destroy', $baju) }}"
                                          onsubmit="return confirm('Yakin hapus baju \'{{ addslashes($baju->nama) }}\'?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-del">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8">
                                <div class="empty-state">
                                    <div class="empty-icon">📭</div>
                                    <div class="empty-text">Belum ada data busana</div>
                                    <div class="empty-sub">Gunakan form di samping untuk menambahkan busana baru</div>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($bajus->total() > 0)
            <div class="pagination-info">
                Menampilkan {{ $bajus->firstItem() }}–{{ $bajus->lastItem() }} dari {{ $bajus->total() }} busana
            </div>
            @endif
        </div>
    </div>

    {{-- MOBILE SECTION: TAMBAH (form saja) --}}
    <div class="mobile-section" id="section-tambah">
        <div class="form-card">
            <h2>Tambah Baju Baru</h2>

            <form method="POST" action="{{ route('admin.baju.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>Kategori *</label>
                    <div class="kategori-checkbox-group">
                        <label class="kategori-checkbox"><input type="checkbox" name="kategori[]" value="adat"> 🏛️ Kostum Adat</label>
                        <label class="kategori-checkbox"><input type="checkbox" name="kategori[]" value="tari"> 💃 Kostum Tari</label>
                        <label class="kategori-checkbox"><input type="checkbox" name="kategori[]" value="musik"> 🎵 Kostum Pemusik</label>
                    </div>
                </div>

                <div class="form-group">
                    <label>Nama Baju *</label>
                    <input type="text" name="nama" placeholder="Contoh: Kebaya Encim" required maxlength="100">
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" rows="3" placeholder="Deskripsi singkat busana..."></textarea>
                </div>

                <div class="form-group">
                    <label>Ketersediaan</label>
                    <select name="ketersediaan">
                        <option value="tersedia">✅ Tersedia</option>
                        <option value="disewa">🔄 Disewa</option>
                        <option value="tidak_tersedia">❌ Tidak Tersedia</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Gambar</label>
                    <div class="gambar-opsi">
                        <div class="gambar-input">
                            <span class="gambar-label">URL</span>
                            <input type="text" name="gambar" id="gambarUrl2" placeholder="https://..." oninput="previewImg2(this.value)">
                        </div>
                        <div class="gambar-divider">atau</div>
                        <div class="gambar-input">
                            <span class="gambar-label">Upload</span>
                            <input type="file" name="gambar_file" accept="image/*" onchange="previewFile2(this)">
                        </div>
                    </div>
                    <p class="helper-text">Masukkan URL atau upload file. Format: JPG, PNG, WEBP. Maks 2MB</p>
                    <div class="img-preview" id="imgPreview2"></div>
                </div>

                <div class="aksesoris-section">
                    <h4>➕ Aksesoris Tambahan</h4>
                    <div id="accContainer2"></div>
                    <button type="button" class="btn-add-acc" onclick="addAcc2()">+ Tambah Aksesoris</button>
                </div>

                <button type="submit" class="btn-submit">
                    💾 Simpan Baju
                </button>
            </form>
        </div>
    </div>

    {{-- DESKTOP LAYOUT --}}
    <div class="desktop-layout">
        <div class="stats-row">
            <div class="stat-card">
                <div class="icon-wrap">📦</div>
                <div class="stat-num">{{ $stats['total'] }}</div>
                <div class="stat-label">Total Busana</div>
            </div>
            <div class="stat-card">
                <div class="icon-wrap">🏛️</div>
                <div class="stat-num">{{ $stats['adat'] }}</div>
                <div class="stat-label">Kostum Adat</div>
            </div>
            <div class="stat-card">
                <div class="icon-wrap">💃</div>
                <div class="stat-num">{{ $stats['tari'] }}</div>
                <div class="stat-label">Kostum Tari</div>
            </div>
            <div class="stat-card">
                <div class="icon-wrap">🎵</div>
                <div class="stat-num">{{ $stats['musik'] }}</div>
                <div class="stat-label">Kostum Pemusik</div>
            </div>
        </div>

            <div class="list-card">
                <div class="list-card-header">
                    <h2>📋 Daftar Busana</h2>
                <div class="header-right">
                    <button type="button" class="btn-tambah-baju" onclick="toggleForm()">➕ Tambah Baju Baru</button>
                </div>
                </div>

                <div class="form-collapse" id="formCollapse">
                    <form method="POST" action="{{ route('admin.baju.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row-2">
                            <div class="form-group">
                                <label>Kategori *</label>
                                <div class="kategori-checkbox-group">
                                    <label class="kategori-checkbox"><input type="checkbox" name="kategori[]" value="adat"> 🏛️ Kostum Adat</label>
                                    <label class="kategori-checkbox"><input type="checkbox" name="kategori[]" value="tari"> 💃 Kostum Tari</label>
                                    <label class="kategori-checkbox"><input type="checkbox" name="kategori[]" value="musik"> 🎵 Kostum Pemusik</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Ketersediaan</label>
                                <select name="ketersediaan">
                                    <option value="tersedia">✅ Tersedia</option>
                                    <option value="disewa">🔄 Disewa</option>
                                    <option value="tidak_tersedia">❌ Tidak Tersedia</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row-2">
                            <div class="form-group">
                                <label>Nama Baju *</label>
                                <input type="text" name="nama" placeholder="Contoh: Kebaya Encim" required maxlength="100">
                            </div>
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea name="deskripsi" rows="2" placeholder="Deskripsi singkat busana..."></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Gambar</label>
                            <div class="gambar-opsi">
                                <div class="gambar-input">
                                    <span class="gambar-label">URL</span>
                                    <input type="text" name="gambar" id="gambarUrl" placeholder="https://..." oninput="previewImg(this.value)">
                                </div>
                                <div class="gambar-divider">atau</div>
                                <div class="gambar-input">
                                    <span class="gambar-label">Upload</span>
                                    <input type="file" name="gambar_file" accept="image/*" onchange="previewFile(this)">
                                </div>
                            </div>
                            <p class="helper-text">Masukkan URL atau upload file. Format: JPG, PNG, WEBP. Maks 2MB</p>
                            <div class="img-preview" id="imgPreview"></div>
                        </div>
                        <div class="aksesoris-section">
                            <h4>➕ Aksesoris Tambahan</h4>
                            <div id="accContainer"></div>
                            <button type="button" class="btn-add-acc" onclick="addAcc()">+ Tambah Aksesoris</button>
                        </div>
                        <button type="submit" class="btn-submit">💾 Simpan Baju</button>
                    </form>
                </div>
                <div class="filter-bar">
                    <a href="{{ route('admin.dashboard', ['kategori' => 'all', 'search' => $search]) }}"
                       class="cat-btn {{ $kategori === 'all' ? 'active' : '' }}">Semua</a>
                    <a href="{{ route('admin.dashboard', ['kategori' => 'adat', 'search' => $search]) }}"
                       class="cat-btn {{ $kategori === 'adat' ? 'active' : '' }}">🏛️ Kostum Adat</a>
                    <a href="{{ route('admin.dashboard', ['kategori' => 'tari', 'search' => $search]) }}"
                       class="cat-btn {{ $kategori === 'tari' ? 'active' : '' }}">💃 Kostum Tari</a>
                    <a href="{{ route('admin.dashboard', ['kategori' => 'musik', 'search' => $search]) }}"
                       class="cat-btn {{ $kategori === 'musik' ? 'active' : '' }}">🎵 Kostum Pemusik</a>
                    <form method="GET" action="{{ route('admin.dashboard') }}" class="search-form">
                        <input type="hidden" name="kategori" value="{{ $kategori }}">
                        <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama/deskripsi...">
                        <button type="submit">Cari</button>
                    </form>
                </div>
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Gambar</th>
                                <th>Kategori</th>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th>Ketersediaan</th>
                                <th>Aksesoris</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bajus as $baju)
                            <tr>
                                <td><img src="{{ $baju->gambar_url }}" class="thumb" onerror="this.src='https://placehold.co/44x44/f7ebda/8b5a2b?text=?'" alt="{{ $baju->nama }}"></td>
                                <td>@foreach((array)$baju->kategori as $kat)<span class="badge-kat kat-{{ $kat }}">{{ ['adat'=>'Kostum Adat','tari'=>'Kostum Tari','musik'=>'Kostum Pemusik'][$kat] ?? $kat }}</span> @endforeach</td>
                                <td class="cell-nama">{{ $baju->nama }}</td>
                                <td>@if($baju->deskripsi)<span class="-desc">{{ Str::limit($baju->deskripsi, 60) }}</span>@else<span class="-desc" style="color:#d0c0a8">—</span>@endif</td>
                                <td class="cell-ketersediaan">
                                    @if($baju->ketersediaan === 'tersedia')
                                        <span class="ketersediaan-badge ketersediaan-tersedia">✅ Tersedia</span>
                                    @elseif($baju->ketersediaan === 'disewa')
                                        <span class="ketersediaan-badge ketersediaan-disewa">🔄 Disewa</span>
                                    @else
                                        <span class="ketersediaan-badge ketersediaan-tidak">❌ Tidak Tersedia</span>
                                    @endif
                                </td>
                                <td class="cell-acc">@if($baju->aksesoris->count())<span title="{{ $baju->aksesoris->pluck('nama')->join(', ') }}">{{ $baju->aksesoris->pluck('nama')->join(', ') }}</span>@else<span class="empty-val">—</span>@endif</td>
                                <td style="text-align:center">@if($baju->aktif)<span class="status-badge aktif">● Aktif</span>@else<span class="status-badge nonaktif">○ Nonaktif</span>@endif</td>
                                <td><div class="actions"><a href="{{ route('admin.baju.edit', $baju) }}" class="btn-edit">Edit</a><form method="POST" action="{{ route('admin.baju.destroy', $baju) }}" onsubmit="return confirm('Yakin hapus baju \'{{ addslashes($baju->nama) }}\'?')">@csrf @method('DELETE')<button type="submit" class="btn-del">Hapus</button></form></div></td>
                            </tr>
                            @empty
                            <tr><td colspan="8"><div class="empty-state"><div class="empty-icon">📭</div><div class="empty-text">Belum ada data busana</div><div class="empty-sub">Gunakan form di samping untuk menambahkan busana baru</div></div></td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($bajus->total() > 0)
                <div class="pagination-info">Menampilkan {{ $bajus->firstItem() }}–{{ $bajus->lastItem() }} dari {{ $bajus->total() }} busana</div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function previewImg(url) {
        const preview = document.getElementById('imgPreview');
        if (url && url.trim()) {
            preview.innerHTML = `<img src="${url}" onerror="this.src='https://placehold.co/130x90/f7ebda/8b5a2b?text=Gagal'">`;
        } else {
            preview.innerHTML = '';
        }
    }

    function previewFile(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('imgPreview').innerHTML = `<img src="${e.target.result}">`;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function addAcc(nama = '') {
        const container = document.getElementById('accContainer');
        const div = document.createElement('div');
        div.className = 'acc-row';
        div.innerHTML = `
            <input type="text" name="aksesoris_nama[]" placeholder="Nama aksesoris" value="${nama.replace(/"/g,'&quot;')}">
            <button type="button" class="btn-remove-acc" onclick="this.parentElement.remove()">✕</button>
        `;
        container.appendChild(div);
    }

    addAcc();

    // -- Mobile form variants --
    function previewImg2(url) {
        const preview = document.getElementById('imgPreview2');
        if (url && url.trim()) {
            preview.innerHTML = `<img src="${url}" onerror="this.src='https://placehold.co/130x90/f7ebda/8b5a2b?text=Gagal'">`;
        } else {
            preview.innerHTML = '';
        }
    }

    function previewFile2(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('imgPreview2').innerHTML = `<img src="${e.target.result}">`;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function addAcc2(nama = '') {
        const container = document.getElementById('accContainer2');
        const div = document.createElement('div');
        div.className = 'acc-row';
        div.innerHTML = `
            <input type="text" name="aksesoris_nama[]" placeholder="Nama aksesoris" value="${nama.replace(/"/g,'&quot;')}">
            <button type="button" class="btn-remove-acc" onclick="this.parentElement.remove()">✕</button>
        `;
        container.appendChild(div);
    }

    addAcc2();

    // Desktop form toggle
    function toggleForm() {
        const form = document.getElementById('formCollapse');
        const btn = document.querySelector('.btn-tambah-baju');
        form.classList.toggle('open');
        btn.classList.toggle('active');
        if (form.classList.contains('open')) {
            btn.textContent = '✕ Tutup Form';
        } else {
            btn.textContent = '➕ Tambah Baju Baru';
        }
    }

    // Mobile admin nav toggle
    document.querySelectorAll('.mobile-admin-nav button').forEach(btn => {
        btn.addEventListener('click', function() {
            if (window.innerWidth > 767) return;
            document.querySelectorAll('.mobile-admin-nav button').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            const section = this.dataset.section;
            document.querySelectorAll('.form-card, .list-card').forEach(el => {
                el.classList.remove('visible');
            });
            document.querySelectorAll('.mobile-section').forEach(el => {
                el.classList.remove('visible');
            });
            const target = document.getElementById('section-' + section);
            if (target) target.classList.add('visible');
        });
    });

    // Close admin dropdown on outside click
    document.addEventListener('click', function(e) {
        var dd = document.getElementById('adminDropdown');
        if (dd && !dd.contains(e.target)) {
            dd.classList.remove('open');
        }
    });
</script>
@endsection
