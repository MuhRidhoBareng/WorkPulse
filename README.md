# WorkPulse — Sistem Monitoring Kinerja

## SKB Dinas Pendidikan

![Logo Kemendikdasmen](public/images/logo-kemendikdasmen.jpg)

**WorkPulse** adalah aplikasi web monitoring kinerja pegawai (Pamong) untuk **Sanggar Kegiatan Belajar (SKB) Dinas Pendidikan**. Aplikasi ini memungkinkan pencatatan kehadiran berbasis foto, pelaporan kegiatan harian, serta rekapitulasi dan evaluasi kinerja oleh pimpinan.

---

## 📋 Daftar Isi

1. [Deskripsi Aplikasi](#-deskripsi-aplikasi)
2. [Fitur Utama](#-fitur-utama)
3. [Teknologi yang Digunakan](#-teknologi-yang-digunakan)
4. [Arsitektur Sistem](#-arsitektur-sistem)
5. [Persyaratan Sistem](#-persyaratan-sistem)
6. [Panduan Instalasi Lokal](#-panduan-instalasi-lokal)
7. [Panduan Hosting Gratis](#-panduan-hosting-gratis)
8. [Akun Default & Role](#-akun-default--role)
9. [Panduan Penggunaan](#-panduan-penggunaan)
10. [Struktur Folder](#-struktur-folder)

---

## 📝 Deskripsi Aplikasi

WorkPulse dirancang untuk membantu **SKB Dinas Pendidikan** dalam mengelola dan memantau kinerja Pamong secara digital. Sistem ini mencakup:

- **Absensi digital** dengan bukti foto selfie (clock in & clock out)
- **Laporan kegiatan** harian dengan upload bukti dokumentasi
- **Verifikasi** oleh Tata Usaha (TU)
- **Rekap kinerja** bulanan oleh Kepala SKB
- **Evaluasi** kinerja Pamong
- **Export Excel** untuk pelaporan formal

---

## ✨ Fitur Utama

### 👩‍🏫 Pamong (Pegawai)
| Fitur | Deskripsi |
|-------|-----------|
| Clock In/Out | Absensi harian dengan **foto selfie wajib** dan pencatatan waktu otomatis |
| Riwayat Kehadiran | Melihat rekap kehadiran bulanan beserta foto yang sudah diupload |
| Laporan Kegiatan | Upload laporan harian dengan judul, deskripsi, dan **bukti foto/dokumen** |
| Profil | Update foto profil dan informasi akun |

### 📋 Tata Usaha / Admin (TU)
| Fitur | Deskripsi |
|-------|-----------|
| Kelola Pengguna | Tambah, edit, aktifkan/nonaktifkan akun Pamong |
| Verifikasi Laporan | Setujui atau tolak laporan kegiatan Pamong |
| Data Kehadiran | Lihat semua data kehadiran beserta **foto bukti absensi** |
| Dashboard Admin | Panel administrasi lengkap menggunakan Filament |

### 👔 Kepala SKB (Pimpinan)
| Fitur | Deskripsi |
|-------|-----------|
| Dashboard | Ringkasan statistik: total pamong, kehadiran hari ini, laporan pending |
| Rekap Kinerja | Tabel ringkasan kinerja bulanan semua Pamong |
| **Export Excel** | Download laporan lengkap dalam format .xlsx (3 sheet: Ringkasan, Detail Kehadiran, Detail Laporan) dengan link foto |
| Evaluasi | Buat penilaian kinerja individu Pamong |

---

## 🛠 Teknologi yang Digunakan

| Komponen | Teknologi | Versi | Keterangan |
|----------|-----------|-------|------------|
| **Bahasa Pemrograman** | PHP | 8.2+ | Backend server-side |
| **Framework Backend** | Laravel | 11.x | Framework PHP modern dengan MVC pattern |
| **Frontend Template** | Blade | - | Template engine bawaan Laravel |
| **CSS Framework** | Tailwind CSS | 3.x | Utility-first CSS framework |
| **JavaScript** | Alpine.js | 3.x | Reactive JavaScript framework ringan |
| **Admin Panel** | Filament | 3.3 | Panel admin modern untuk CRUD & dashboard |
| **Database** | SQLite / MySQL | - | SQLite untuk development, MySQL untuk production |
| **Build Tool** | Vite | 5.x | Fast frontend build tool |
| **Export Excel** | PhpSpreadsheet | 5.x | Generate file .xlsx dengan format profesional |
| **Authentication** | Laravel Breeze | 2.x | Starter kit untuk login, register, profil |

### Dependensi Utama (composer.json)
```
php >= 8.2
laravel/framework ^11.31
filament/filament 3.3
phpoffice/phpspreadsheet ^5.4
laravel/breeze ^2.3 (dev)
```

---

## 🏗 Arsitektur Sistem

```
┌─────────────────────────────────────────────────┐
│                   BROWSER                       │
│  (Desktop / Mobile — Chrome, Safari, Firefox)   │
└──────────────────────┬──────────────────────────┘
                       │ HTTP
┌──────────────────────▼──────────────────────────┐
│              LARAVEL APPLICATION                │
│                                                 │
│  ┌──────────┐  ┌──────────┐  ┌──────────────┐  │
│  │  Routes  │→ │Controllers│→ │    Models    │  │
│  │ (web.php)│  │  (MVC)   │  │  (Eloquent)  │  │
│  └──────────┘  └──────────┘  └──────┬───────┘  │
│                                      │          │
│  ┌──────────┐  ┌──────────┐  ┌──────▼───────┐  │
│  │  Views   │  │ Filament │  │   Database   │  │
│  │ (Blade)  │  │ (Admin)  │  │   (SQLite/   │  │
│  └──────────┘  └──────────┘  │    MySQL)    │  │
│                              └──────────────┘  │
│  ┌──────────────────────────────────────────┐  │
│  │          Storage (public/)               │  │
│  │  profile-photos/ attendance-photos/      │  │
│  │  activity-documents/                     │  │
│  └──────────────────────────────────────────┘  │
└─────────────────────────────────────────────────┘
```

### Pola URL (Routing)
| Path | Role | Fungsi |
|------|------|--------|
| `/` | Guest | Redirect ke halaman login |
| `/login` | Guest | Halaman login dengan info role |
| `/register` | Guest | Pendaftaran akun baru |
| `/pamong/*` | Pamong | Dashboard, kehadiran, laporan |
| `/kepala/*` | Kepala SKB | Dashboard, rekap, evaluasi |
| `/admin/*` | TU | Panel admin Filament |

---

## 💻 Persyaratan Sistem

### Untuk Menjalankan Lokal
- **PHP** >= 8.2 (termasuk ekstensi: mbstring, openssl, pdo, tokenizer, xml, ctype, json, bcmath, gd/imagick)
- **Composer** >= 2.x
- **Node.js** >= 18.x + NPM
- **Git**
- Database: **SQLite** (default, tanpa installasi tambahan) atau **MySQL** 8.x

### Untuk Hosting
- PHP >= 8.2 (shared hosting atau VPS)
- MySQL/MariaDB (disediakan oleh hosting)
- SSL certificate (biasanya gratis di hosting)

---

## 🚀 Panduan Instalasi Lokal

### Langkah 1: Clone / Copy Project
```bash
# Jika menggunakan Git
git clone <repository-url> WorkPulse
cd WorkPulse

# Atau jika copy manual, extract ke folder dan buka terminal di folder tersebut
```

### Langkah 2: Install Dependensi PHP
```bash
composer install
```

### Langkah 3: Konfigurasi Environment
```bash
# Copy file konfigurasi
cp .env.example .env

# Generate application key
php artisan key:generate
```

Edit file `.env` sesuai kebutuhan:
```env
APP_NAME=WorkPulse
APP_URL=http://localhost:8000

# Database (default: SQLite)
DB_CONNECTION=sqlite
# DB_DATABASE=/path/to/database.sqlite

# Jika menggunakan MySQL:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=workpulse
# DB_USERNAME=root
# DB_PASSWORD=
```

### Langkah 4: Setup Database
```bash
# Buat file database SQLite (jika belum ada)
touch database/database.sqlite

# Jalankan migrasi
php artisan migrate

# (Opsional) Isi data awal/seed
php artisan db:seed
```

### Langkah 5: Storage Link
```bash
php artisan storage:link
```
> Perintah ini membuat symbolic link dari `public/storage` ke `storage/app/public` agar file upload bisa diakses via browser.

### Langkah 6: Install Dependensi Frontend
```bash
npm install
```

### Langkah 7: Jalankan Aplikasi
```bash
# Terminal 1: Build frontend
npm run dev

# Terminal 2: Jalankan server
php artisan serve
```

Buka browser: **http://localhost:8000**

### Akses dari HP (Jaringan WiFi yang Sama)
```bash
php artisan serve --host=0.0.0.0 --port=8000
```
Lalu buka **http://[IP-Komputer]:8000** di browser HP.
> Cari IP komputer dengan perintah `ipconfig` (Windows) atau `ifconfig` (Mac/Linux)

---

## 🌐 Panduan Hosting Gratis

### Opsi 1: Railway.app (Gratis — Paling Mudah)

1. Daftar di [railway.app](https://railway.app)
2. Buat project baru → Deploy from GitHub
3. Tambah service **MySQL** (klik + New → MySQL)
4. Set environment variables:
   ```
   APP_KEY=base64:xxxxxxxxx (dari .env lokal)
   APP_URL=https://nama-project.up.railway.app
   DB_CONNECTION=mysql
   DB_HOST=${{MySQL.MYSQLHOST}}
   DB_PORT=${{MySQL.MYSQLPORT}}
   DB_DATABASE=${{MySQL.MYSQLDATABASE}}
   DB_USERNAME=${{MySQL.MYSQLUSER}}
   DB_PASSWORD=${{MySQL.MYSQLPASSWORD}}
   ```
5. Tambah `Procfile` di root project:
   ```
   web: php artisan migrate --force && php artisan storage:link && php artisan serve --host=0.0.0.0 --port=$PORT
   ```

### Opsi 2: InfinityFree / 000webhost (Shared Hosting Gratis)

1. Daftar di [infinityfree.com](https://infinityfree.com) atau [000webhost.com](https://000webhost.com)
2. Buat hosting baru → catat detail MySQL (host, database, username, password)
3. Upload file project via File Manager atau FTP:
   - Upload seluruh isi project ke folder `htdocs/` atau `public_html/`
   - Pindahkan isi folder `public/` ke root hosting
   - Edit `index.php` ubah path:
     ```php
     require __DIR__.'/../vendor/autoload.php';
     // menjadi:
     require __DIR__.'/vendor/autoload.php';

     $app = require_once __DIR__.'/../bootstrap/app.php';
     // menjadi:
     $app = require_once __DIR__.'/bootstrap/app.php';
     ```
4. Edit `.env` dengan detail MySQL dari hosting
5. Jalankan migrasi via terminal hosting atau buat route sementara

### Opsi 3: Vercel / Netlify (Tidak Disarankan)
> ⚠️ Vercel dan Netlify **tidak mendukung PHP** secara native. Hanya cocok untuk frontend statis.

### Tips Hosting
- Selalu gunakan **HTTPS** di production
- Set `APP_ENV=production` dan `APP_DEBUG=false`
- Jalankan `php artisan config:cache` dan `php artisan route:cache` untuk performa
- Untuk build CSS/JS: jalankan `npm run build` lalu upload folder `public/build/`

---

## 👥 Akun Default & Role

| Role | Akses | Keterangan |
|------|-------|------------|
| **pamong** | `/pamong/*` | Pegawai SKB — absensi & laporan |
| **tu** | `/admin/*` | Tata Usaha — admin panel Filament |
| **kepala_skb** | `/kepala/*` | Kepala SKB — rekap & evaluasi |

### Membuat Akun Admin (TU) Pertama
```bash
php artisan tinker

# Buat user TU
App\Models\User::create([
    'name' => 'Admin TU',
    'nip' => '000000000000000000',
    'email' => 'tu@workpulse.com',
    'password' => bcrypt('password123'),
    'role' => 'tu',
    'is_active' => true,
]);
```

### Alur Pendaftaran
1. User baru mendaftar melalui halaman **Register** (otomatis role: `pamong`)
2. Akun baru berstatus **non-aktif** secara default
3. **TU** mengaktifkan akun via panel admin (`/admin/users`)
4. User baru bisa login setelah diaktifkan

---

## 📖 Panduan Penggunaan

### Untuk Pamong
1. **Login** → Diarahkan ke Dashboard Pamong
2. **Clock In** → Pilih menu Kehadiran → Upload foto selfie → Klik "Clock In"
3. **Clock Out** → Di halaman yang sama → Upload foto selfie → Klik "Clock Out"
4. **Buat Laporan** → Pilih menu Laporan → Klik "Buat Laporan Baru" → Isi form + upload bukti → Submit
5. **Lihat Riwayat** → Riwayat kehadiran dan status laporan tersedia di masing-masing halaman

### Untuk TU (Admin)
1. **Login** → Diarahkan ke Panel Admin Filament (`/admin`)
2. **Kelola Pengguna** → Menu "Pengguna" → Aktifkan/nonaktifkan akun, ubah role
3. **Verifikasi Laporan** → Menu "Laporan Kegiatan" → Klik laporan → Setujui atau Tolak
4. **Lihat Kehadiran** → Menu "Data Kehadiran" → Lihat foto absensi setiap Pamong

### Untuk Kepala SKB
1. **Login** → Diarahkan ke Dashboard Kepala
2. **Lihat Rekap** → Menu Rekap → Pilih bulan/tahun → Lihat persentase kinerja
3. **Export Excel** → Klik tombol "Export Excel" → File .xlsx terdownload dengan 3 sheet (Ringkasan, Detail Kehadiran, Detail Laporan)
4. **Evaluasi** → Menu Evaluasi → Buat penilaian kinerja per Pamong

---

## 📁 Struktur Folder

```
WorkPulse/
├── app/
│   ├── Filament/             # Panel Admin (TU) - Filament Resources
│   │   ├── Resources/        # CRUD: Users, Attendance, ActivityReport
│   │   └── Widgets/          # Widget dashboard admin
│   ├── Http/Controllers/
│   │   ├── Auth/             # Login, Register, Password Reset
│   │   ├── Kepala/           # DashboardController, RekapController, PerformanceReviewController
│   │   ├── Pamong/           # DashboardController, AttendanceController, ActivityReportController
│   │   └── ProfileController.php
│   └── Models/               # User, Attendance, ActivityReport, PerformanceReview
├── database/
│   ├── migrations/           # Skema database
│   └── seeders/              # Data awal
├── public/
│   ├── images/               # Logo Kemendikdasmen
│   └── storage/ → ../storage/app/public  # Symlink untuk file upload
├── resources/views/
│   ├── auth/                 # Login & Register
│   ├── kepala/               # Views untuk Kepala SKB
│   ├── layouts/              # Layout utama (app, guest, navigation)
│   ├── pamong/               # Views untuk Pamong
│   └── profile/              # Halaman profil
├── routes/
│   ├── web.php               # Routing utama
│   └── auth.php              # Routing autentikasi
├── storage/app/public/
│   ├── attendance-photos/    # Foto absen clock in/out
│   ├── activity-documents/   # Bukti laporan kegiatan
│   └── profile-photos/       # Foto profil user
├── .env                      # Konfigurasi environment
├── composer.json             # Dependensi PHP
└── package.json              # Dependensi JS/CSS
```

---

## 📞 Dukungan

Jika ada kendala teknis, hubungi developer atau buka issue di repository.

---

*Dibuat dengan ❤️ untuk SKB Dinas Pendidikan*
