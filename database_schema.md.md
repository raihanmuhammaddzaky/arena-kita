# CONTEXT ENGINEERING: Database Architecture (ArenaKita)

**Role:** Anda adalah Senior Backend Developer dan Database Architect yang ahli di Laravel 11 dan MySQL.
**Task:** Buatkan saya struktur *Database Migrations* dan *Eloquent Models* beserta relasinya untuk aplikasi "ArenaKita" (Sistem Reservasi Fasilitas Olahraga Mandiri).
**Constraint:** TIDAK ADA integrasi otomatisasi pihak ketiga (tidak ada notifikasi bot/email otomatis). Semuanya dikelola secara manual. Implementasi kode harus sangat konkret, berfokus pada efisiensi query dan integritas data (3NF).

## ATURAN BISNIS & INTEGRITAS DATA (WAJIB DIIKUTI)
1. **Audit Trail (Pemisahan Transaksi & Keuangan):** Data pesanan operasional wajib dipisah dengan data pembayaran keuangan untuk menjaga rekam jejak jika terjadi penolakan (reject) struk manual oleh Admin.
2. **Historical Snapshot:** Kolom `total_price` pada tabel `bookings` BUKAN *calculated field* yang berubah-ubah. Nilai ini harus di-*insert* saat transaksi dibuat sebagai *snapshot* kesepakatan, sehingga jika harga master fasilitas berubah di masa depan, laporan keuangan historis tidak rusak.
3. **Pessimistic Locking Readiness:** Struktur tabel harus mendukung eksekusi `lockForUpdate()` di sisi Controller nantinya.
4. **Image Management:** Setiap fasilitas (`venues`) memiliki maksimal 4 gambar (1 gambar utama, 3 gambar pendukung). Penyimpanan *path* gambar harus dipisah ke tabel `venue_images`.

---

## SPESIFIKASI SKEMA TABEL

### 1. Tabel: `users`
*Tabel untuk autentikasi dan otorisasi aktor sistem.*
* `id` (Primary Key)
* `name` (string)
* `email` (string, unique)
* `password` (string)
* `phone` (string)
* `role` (enum: 'admin', 'renter') -> Default tidak ada, wajib diisi eksplisit.
* `status` (enum: 'pending', 'approved', 'rejected') -> Default: 'pending'.
* `timestamps`

### 2. Tabel: `venues`
*Tabel master data untuk entitas lapangan/fasilitas.*
* `id` (Primary Key)
* `name` (string)
* `address` (text) -> Alamat lengkap fasilitas.
* `description` (text)
* `price` (integer) -> Contoh: 50000
* `time_unit_minutes` (integer) -> Contoh: 60 (Harga 50rb per 60 menit)
* `max_capacity` (integer) -> Kapasitas maksimum pemain (Contoh: 4 untuk lapangan badminton ganda).
* `is_active` (boolean) -> Default: true (Untuk soft-delete visual)
* `timestamps`

### 3. Tabel: `venue_images`
*Tabel relasional untuk menyimpan galeri foto masing-masing fasilitas.*
* `id` (Primary Key)
* `venue_id` (Foreign Key -> venues.id, constrained, cascade on delete)
* `image_path` (string) -> Path penyimpanan file gambar.
* `is_main` (boolean) -> Default: false. (Hanya 1 gambar per venue_id yang boleh bernilai true).
* `timestamps`

### 4. Tabel: `bookings`
*Tabel operasional inti. Wajib memiliki indeks untuk pencarian cepat.*
* `id` (Primary Key)
* `user_id` (Foreign Key -> users.id, constrained, cascade on delete)
* `venue_id` (Foreign Key -> venues.id, constrained, cascade on delete)
* `booking_date` (date) -> Tambahkan Index.
* `start_time` (time)
* `end_time` (time)
* `total_price` (decimal/unsignedBigInteger) -> Snapshot harga kesepakatan.
* `status` (enum: 'unpaid', 'pending_verification', 'confirmed', 'cancelled') -> Default: 'unpaid'.
* `timestamps`
* **Constraint Tambahan:** Tambahkan composite index pada `(venue_id, booking_date)` untuk mempercepat algoritma pengecekan irisan waktu (Time Overlap).

### 5. Tabel: `payments`
*Tabel pencatatan jejak audit keuangan manual.*
* `id` (Primary Key)
* `booking_id` (Foreign Key -> bookings.id, constrained, cascade on delete)
* `proof_image` (string) -> Path untuk file JPG/PNG bukti transfer.
* `status` (enum: 'pending', 'verified', 'rejected') -> Default: 'pending'.
* `timestamps`

### 6. Tabel: `announcements`
*Tabel sistem informasi satu arah dari Admin ke Penyewa.*
* `id` (Primary Key)
* `title` (string)
* `content` (text)
* `timestamps`

---

## OUTPUT YANG DIHARAPKAN
1. Tuliskan skrip lengkap `Migration` Laravel untuk ke-6 tabel di atas dengan urutan pembuatan yang benar (memperhatikan *foreign key constraints*).
2. Tuliskan kode `Eloquent Model` untuk masing-masing tabel lengkap dengan konfigurasi `$fillable`, *Casts* (terutama untuk enum/date/time), dan definisi *Relationships* (hasMany, belongsTo, hasOne). Khusus untuk model `Venue`, buatkan relasi `images()` (hasMany) dan fungsi *helper* `mainImage()` (hasOne) untuk mengambil gambar utama.