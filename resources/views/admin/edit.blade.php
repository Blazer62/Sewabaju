@extends('layouts.app')

@section('title', 'Edit Baju - Panel Admin')

@section('styles')
<style>
    body {
        background: linear-gradient(135deg, #fef9e6 0%, #f5ede0 100%);
        padding: 24px;
        min-height: 100vh;
    }

    .edit-container { max-width: 860px; margin: 0 auto; }

    .edit-header {
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
        animation: fadeUp 0.3s ease both;
    }

    .edit-header h1 {
        font-family: 'Playfair Display', serif;
        font-size: 1.35rem;
        color: var(--coklat-tua);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-back {
        background: var(--krem);
        color: var(--coklat-tua);
        padding: 10px 22px;
        border-radius: 40px;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.82rem;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border: 1.5px solid var(--border);
    }
    .btn-back:hover {
        background: var(--emas);
        border-color: var(--emas);
        transform: translateY(-1px);
    }

    .edit-card {
        background: white;
        border-radius: 20px;
        padding: 32px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 8px 24px rgba(0,0,0,0.05);
        border: 1px solid rgba(230,200,160,0.2);
        animation: fadeUp 0.3s ease 0.1s both;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .edit-card h2 {
        font-family: 'Playfair Display', serif;
        color: var(--coklat-tua);
        margin-bottom: 24px;
        font-size: 1.1rem;
        padding-bottom: 14px;
        border-bottom: 2px solid #f3e8d5;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .edit-card h2::before {
        content: '';
        width: 4px;
        height: 22px;
        background: linear-gradient(180deg, var(--coklat-tua), var(--emas));
        border-radius: 4px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
    }

    .form-group { margin-bottom: 18px; }

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

    .form-group textarea { resize: vertical; }

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
        max-width: 180px;
        max-height: 120px;
        border-radius: 8px;
        object-fit: cover;
    }

    .aksesoris-section {
        background: #fdfaf5;
        border-radius: 14px;
        padding: 18px;
        margin-bottom: 18px;
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

    .form-actions {
        display: flex;
        gap: 12px;
        margin-top: 4px;
        flex-wrap: wrap;
    }

    .btn-save {
        flex: 1;
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
        box-shadow: 0 6px 20px rgba(139,90,43,0.25);
        letter-spacing: 0.3px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 28px rgba(139,90,43,0.35);
    }

    .btn-cancel {
        padding: 14px 28px;
        background: var(--krem);
        color: var(--coklat-tua);
        border: 1.5px solid var(--border);
        border-radius: 40px;
        font-family: 'Nunito', sans-serif;
        font-size: 0.9rem;
        font-weight: 700;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s;
    }

    .btn-cancel:hover {
        background: var(--emas);
        border-color: var(--emas);
        transform: translateY(-1px);
    }

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

    .aktif-toggle {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        background: #f0faf0;
        border: 1.5px solid #c8e6c9;
        border-radius: 12px;
        transition: 0.2s;
    }

    .aktif-toggle:hover { border-color: #a8d8aa; }

    .aktif-toggle input {
        width: 20px;
        height: 20px;
        accent-color: var(--hijau);
        cursor: pointer;
    }

    .aktif-toggle label {
        font-weight: 700;
        font-size: 0.85rem;
        color: var(--hijau);
        cursor: pointer;
    }

    @media (max-width: 700px) {
        .form-row { grid-template-columns: 1fr; }
        .kategori-checkbox-group { grid-template-columns: repeat(2, 1fr); }
        .acc-row { grid-template-columns: 1fr 32px; gap: 4px; }
    }

    @media (max-width: 640px) {
        body { padding: 12px; }
        .edit-header { padding: 12px 16px; border-radius: 14px; flex-direction: column; align-items: stretch; gap: 8px; }
        .edit-header h1 { font-size: 1rem; }
        .edit-card { padding: 18px; border-radius: 14px; }
        .edit-card h2 { font-size: 1rem; margin-bottom: 16px; }
        .form-group { margin-bottom: 14px; }
        .form-group input, .form-group select, .form-group textarea { padding: 10px 12px; font-size: 0.82rem; }
        .form-group select { max-width: 100%; font-size: 0.76rem; padding: 8px 10px; }
        .form-group select option { font-size: 0.76rem; padding: 4px 6px; }
        .gambar-opsi { flex-direction: column; gap: 6px; }
        .gambar-divider { font-size: 0.65rem; }
        .btn-back { padding: 8px 16px; font-size: 0.78rem; text-align: center; }
        .btn-save { padding: 12px; font-size: 0.85rem; }
        .btn-cancel { padding: 12px 20px; font-size: 0.82rem; text-align: center; }
        .aktif-toggle { padding: 10px 14px; }
        .aktif-toggle label { font-size: 0.8rem; }
        .aksesoris-section { padding: 14px; }
        .kategori-checkbox { font-size: 0.78rem; padding: 6px 4px; }
        .kategori-checkbox input[type="checkbox"] { width: 14px; height: 14px; }
        .form-actions { flex-direction: column; gap: 8px; }
        .form-actions .btn-save, .form-actions .btn-cancel { width: 100%; justify-content: center; }
    }

    @media (max-width: 480px) {
        body { padding: 8px; }
        .edit-header { padding: 10px 12px; }
        .edit-header h1 { font-size: 0.9rem; }
        .edit-card { padding: 14px; }
        .form-row .form-group select { font-size: 0.72rem; padding: 6px 8px; max-width: 140px; }
        .form-row .form-group select option { font-size: 0.72rem; padding: 2px 4px; }
        .kategori-checkbox-group { grid-template-columns: 1fr; gap: 4px; }
        .acc-row { grid-template-columns: 1fr 30px; gap: 4px; }
    }
</style>
@endsection

@section('content')
<div class="edit-container">

    <div class="edit-header">
        <h1>✏️ Edit Baju: {{ $baju->nama }}</h1>
        <a href="{{ route('admin.dashboard') }}" class="btn-back">← Kembali</a>
    </div>

    <div class="edit-card">
        <h2>Form Edit Busana</h2>

        <form method="POST" action="{{ route('admin.baju.update', $baju) }}">
            @csrf
            @method('PUT')

            <div class="form-row">
                <div class="form-group">
                    <label>Kategori *</label>
                    <div class="kategori-checkbox-group">
                        @foreach(['adat'=>'🏛️ Kostum Adat','tari'=>'💃 Kostum Tari','musik'=>'🎵 Kostum Pemusik'] as $val => $label)
                            <label class="kategori-checkbox"><input type="checkbox" name="kategori[]" value="{{ $val }}" {{ in_array($val, (array)$baju->kategori) ? 'checked' : '' }}> {{ $label }}</label>
                        @endforeach
                    </div>
                </div>

                <div class="form-group">
                    <label>Ketersediaan</label>
                    <select name="ketersediaan">
                        <option value="tersedia" {{ $baju->ketersediaan === 'tersedia' ? 'selected' : '' }}>✅ Tersedia</option>
                        <option value="disewa" {{ $baju->ketersediaan === 'disewa' ? 'selected' : '' }}>🔄 Disewa</option>
                        <option value="tidak_tersedia" {{ $baju->ketersediaan === 'tidak_tersedia' ? 'selected' : '' }}>❌ Tidak Tersedia</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>Nama Baju *</label>
                <input type="text" name="nama" value="{{ $baju->nama }}" required maxlength="100">
            </div>

            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="deskripsi" rows="3">{{ $baju->deskripsi }}</textarea>
            </div>

            <div class="form-group">
                <label>Gambar (URL)</label>
                <div class="gambar-input" style="width:100%">
                    <span class="gambar-label">URL</span>
                    <input type="url" name="gambar" id="gambarUrl"
                           value="{{ str_starts_with($baju->gambar ?? '', 'http') ? $baju->gambar : '' }}"
                           placeholder="https://..."
                           oninput="previewImg(this.value)">
                </div>
                <p class="helper-text">Masukkan URL gambar. Format: JPG, PNG, WEBP</p>
                <div class="img-preview" id="imgPreview">
                    <img src="{{ $baju->gambar_url }}" onerror="this.remove()">
                </div>
            </div>

            <div class="form-group">
                <div class="aktif-toggle">
                    <input type="hidden" name="aktif" value="0">
                    <input type="checkbox" id="aktif" name="aktif" value="1" {{ $baju->aktif ? 'checked' : '' }}>
                    <label for="aktif">✅ Busana aktif & ditampilkan ke penyewa</label>
                </div>
            </div>

            <div class="aksesoris-section">
                <h4>➕ Aksesoris Tambahan</h4>
                <div id="accContainer">
                    @foreach($baju->aksesoris as $acc)
                    <div class="acc-row">
                        <input type="text" name="aksesoris_nama[]" value="{{ $acc->nama }}" placeholder="Nama aksesoris">
                        <button type="button" class="btn-remove-acc" onclick="this.parentElement.remove()">✕</button>
                    </div>
                    @endforeach
                </div>
                <button type="button" class="btn-add-acc" onclick="addAcc()">+ Tambah Aksesoris</button>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-save">💾 Simpan Perubahan</button>
                <a href="{{ route('admin.dashboard') }}" class="btn-cancel">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function previewImg(url) {
        const preview = document.getElementById('imgPreview');
        if (url && url.trim()) {
            preview.innerHTML = `<img src="${url}" onerror="this.src='https://placehold.co/160x100/f7ebda/8b5a2b?text=Gagal'">`;
        } else {
            preview.innerHTML = '';
        }
    }

    function addAcc(nama = '') {
        const container = document.getElementById('accContainer');
        const div = document.createElement('div');
        div.className = 'acc-row';
        div.innerHTML = `
            <input type="text" name="aksesoris_nama[]" placeholder="Nama aksesoris" value="${nama}">
            <button type="button" class="btn-remove-acc" onclick="this.parentElement.remove()">✕</button>
        `;
        container.appendChild(div);
    }
</script>
@endsection
