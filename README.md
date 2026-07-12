# 🎭 Sanggar Seni Nuansa Official — Website Sewa Baju
### Dibangun dengan Laravel + MySQL (Database: `Sewabaju`)

---

## 📁 Struktur Proyek

```
sewabaju-laravel/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/AdminAuthController.php   ← Login/logout admin
│   │   │   ├── AdminBajuController.php        ← CRUD baju (admin)
│   │   │   └── PenyewaController.php          ← Halaman publik
│   │   └── Middleware/
│   │       └── AdminAuth.php                  ← Proteksi halaman admin
│   └── Models/
│       ├── Baju.php
│       ├── Aksesoris.php
│       └── Admin.php
├── config/
│   ├── auth.php        ← Guard 'admin' dikonfigurasi di sini
│   └── database.php    ← Database: Sewabaju
├── database/
│   ├── migrations/
│   │   ├── ..._create_bajus_table.php
│   │   ├── ..._create_aksesoris_table.php
│   │   └── ..._create_admins_table.php
│   └── seeders/
│       └── DatabaseSeeder.php   ← Data awal + admin default
├── resources/views/
│   ├── layouts/app.blade.php
│   ├── auth/login.blade.php      ← Halaman login admin
│   ├── admin/
│   │   ├── dashboard.blade.php   ← Panel manajemen baju
│   │   └── edit.blade.php        ← Form edit baju
│   └── penyewa/
│       └── index.blade.php       ← Halaman publik penyewa
└── routes/web.php
```

---

## 🚀 Cara Install & Menjalankan

### Prasyarat
- PHP >= 8.1
- Composer
- MySQL / MariaDB
- Node.js (opsional, untuk assets)

### Langkah Instalasi

**1. Buat proyek Laravel baru dan salin file**
```bash
composer create-project laravel/laravel sewabaju
cd sewabaju
```

**2. Salin semua file dari folder ini ke proyek Laravel**
- Salin folder `app/`, `config/`, `database/`, `resources/views/`, `routes/web.php`

**3. Buat database MySQL**
```sql
CREATE DATABASE Sewabaju CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

**4. Konfigurasi `.env`**
```env
APP_NAME="Sanggar Seni Nuansa Official"
DB_DATABASE=Sewabaju
DB_USERNAME=root
DB_PASSWORD=
```

**5. Generate key & daftarkan middleware**

Di `bootstrap/app.php` (Laravel 11) atau `app/Http/Kernel.php` (Laravel 10):
```php
// Laravel 11 - bootstrap/app.php
->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'admin.auth' => \App\Http\Middleware\AdminAuth::class,
    ]);
})
```

```bash
php artisan key:generate
php artisan storage:link
```

**6. Jalankan migrasi & seeder**
```bash
php artisan migrate
php artisan db:seed
```

**7. Jalankan server**
```bash
php artisan serve
```

---

## 🔗 URL Halaman

| Halaman | URL |
|---------|-----|
| 🏠 Beranda Penyewa | `http://localhost:8000/` |
| 🔐 Login Admin | `http://localhost:8000/admin/login` |
| 📋 Dashboard Admin | `http://localhost:8000/admin/dashboard` |

---

## 🔐 Akun Admin Default

| Field | Value |
|-------|-------|
| Email | `admin@nuansa.id` |
| Password | `nuansa2024` |

> ⚠️ **Ganti password setelah login pertama!**

---

## ✨ Fitur Utama

### Halaman Penyewa (Publik)
- ✅ Tampilan busana per kategori (Tradisional, Adat, Tari, Musik)
- ✅ Kalkulator harga aksesoris (centang/hapus aksesoris)
- ✅ Pencarian busana per kategori
- ✅ Smooth scroll & mobile responsive
- ✅ Bagian FAQ & Kontak
- ✅ **Tidak ada tombol admin** — hanya link di footer

### Halaman Admin (Terproteksi Login)
- ✅ **Login wajib** — tidak bisa diakses tanpa autentikasi
- ✅ Dashboard statistik jumlah busana per kategori
- ✅ Tambah baju baru (dengan aksesoris)
- ✅ Edit baju (nama, harga, gambar, aksesoris, status aktif)
- ✅ Hapus baju
- ✅ Filter & pencarian di tabel
- ✅ Upload gambar atau URL gambar
- ✅ Pagination

---

## 📊 Struktur Database

### Tabel `bajus`
| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| id | bigint | Primary key |
| nama | varchar(100) | Nama busana |
| deskripsi | text | Deskripsi |
| harga_dasar | decimal(12,2) | Harga dasar sewa |
| gambar | varchar(500) | URL atau path gambar |
| kategori | enum | tradisional/adat/tari/musik |
| aktif | boolean | Tampil/sembunyikan dari penyewa |
| timestamps | | created_at, updated_at |

### Tabel `aksesoris`
| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| id | bigint | Primary key |
| baju_id | bigint | FK ke bajus |
| nama | varchar(100) | Nama aksesoris |
| harga | decimal(12,2) | Harga tambahan |

### Tabel `admins`
| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| id | bigint | Primary key |
| name | varchar | Nama admin |
| email | varchar | Email (unique) |
| password | varchar | Bcrypt hash |
