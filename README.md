# Arena Kita

Arena Kita adalah aplikasi berbasis web yang dibangun menggunakan framework Laravel. Dokumen ini menjelaskan cara melakukan instalasi dan menjalankan aplikasi ini di lingkungan lokal Anda menggunakan [Laragon](https://laragon.org/).

## Persyaratan Sistem

Sebelum menjalankan aplikasi, pastikan sistem Anda memiliki:
- **Laragon** (disarankan versi Full yang sudah mencakup Apache/Nginx, MySQL, PHP)
- **PHP** >= 8.1 (sesuai kebutuhan versi Laravel yang digunakan)
- **Composer** (sudah termasuk dalam Laragon)
- **Node.js** & **npm** (sudah termasuk dalam Laragon)
- **Git** (untuk melakukan clone repository)

## Langkah-langkah Instalasi

Ikuti langkah-langkah di bawah ini untuk menjalankan aplikasi di lokal menggunakan Laragon:

### 1. Clone Repository

Buka terminal (sangat disarankan menggunakan terminal bawaan Laragon) dan masuk ke folder `www` pada instalasi Laragon Anda (biasanya di `C:\laragon\www`). Lalu jalankan perintah berikut:

```bash
git clone https://github.com/raihanmuhammaddzaky/arena-kita.git
cd arena-kita
```
*(Catatan: Sesuaikan URL repository jika URL yang digunakan berbeda)*

### 2. Install Dependensi PHP (Composer)

Setelah masuk ke dalam folder proyek, jalankan perintah berikut untuk menginstal semua library PHP yang dibutuhkan oleh aplikasi:

```bash
composer install
```

### 3. Install Dependensi Frontend (NPM)

Aplikasi ini menggunakan Node.js untuk mengelola dan mengkompilasi aset frontend (seperti CSS, JavaScript, Tailwind, Vite, dll). Jalankan perintah berikut:

```bash
npm install
npm run build
```
*(Catatan: Gunakan `npm run dev` jika Anda ingin melakukan pengembangan/perubahan kode dan melihat hasilnya secara realtime).*

### 4. Konfigurasi Environment File (.env)

Aplikasi membutuhkan file konfigurasi environment. Salin file `.env.example` menjadi `.env`:

```bash
cp .env.example .env
```
*(Jika menggunakan Windows Command Prompt, jalankan: `copy .env.example .env`)*

Buka file `.env` menggunakan teks editor pilihan Anda (misalnya VS Code) dan sesuaikan konfigurasi database dengan Laragon Anda. Biasanya seperti ini:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=arena_kita   # (Atau nama database yang akan Anda buat di langkah 6)
DB_USERNAME=root
DB_PASSWORD=             # (Biarkan kosong jika ini adalah pengaturan default Laragon)
```

### 5. Generate Application Key

Jalankan perintah ini untuk membuat key enkripsi aplikasi Laravel Anda:

```bash
php artisan key:generate
```

### 6. Buat Database dan Jalankan Migrasi

1. Buka aplikasi **Laragon** Anda dan pastikan servis **MySQL** sudah berjalan (Anda bisa klik tombol `Start All`).
2. Buat database baru di MySQL dengan nama yang sama persis seperti yang Anda masukkan di `DB_DATABASE` pada file `.env` (misalnya: `arena_kita`). Anda bisa menggunakan fitur `Database` di Laragon yang biasanya membuka HeidiSQL, phpMyAdmin, atau tools lainnya.
3. Setelah database berhasil dibuat, jalankan migrasi dan seeder untuk membangun struktur tabel dan mengisi data awal aplikasi:

```bash
php artisan migrate --seed
```

### 7. Link Storage (Opsional namun disarankan)

Untuk memastikan gambar atau file yang diupload dapat diakses melalui web secara publik, jalankan:

```bash
php artisan storage:link
```

### 8. Menjalankan Aplikasi

Jika Anda menggunakan Laragon dan fitur *Auto Virtual Hosts* aktif, Anda bisa langsung membuka browser dan mengakses:
`http://arena-kita.test` (menyesuaikan nama folder proyek, jika foldernya `arena-kita` maka URLnya adalah `arena-kita.test`).

Sebagai alternatif, Anda juga bisa menggunakan server lokal bawaan PHP/Laravel dengan menjalankan:

```bash
php artisan serve
```
Lalu akses aplikasi melalui browser di URL: `http://localhost:8000` atau `http://127.0.0.1:8000`.

---
**Selesai!** Aplikasi Arena Kita sekarang sudah berjalan di perangkat lokal Anda.
