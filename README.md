# Jurnal PKL

Aplikasi web untuk mencatat kegiatan harian selama Praktik Kerja Lapangan (PKL). Setiap pengguna memiliki akun dan jurnalnya sendiri, dapat mengatur data tempat PKL, serta mengunduh laporan kegiatan dalam bentuk PDF.

## Fitur

- Registrasi, login, logout, dan reset password bawaan Laravel Breeze.
- Dashboard ringkas: jumlah kegiatan, kegiatan terbaru, pengingat pengisian jurnal, dan total jam kerja hari ini.
- Tambah, lihat, ubah, dan hapus kegiatan jurnal.
- Filter riwayat kegiatan berdasarkan tanggal dan kata kunci uraian kegiatan.
- Validasi jam selesai harus setelah jam mulai dan tidak boleh bertabrakan dengan jurnal pengguna pada tanggal yang sama.
- Isolasi data: pengguna hanya dapat melihat dan mengubah kegiatan miliknya sendiri.
- Data profil PKL: nama perusahaan/instansi, alamat perusahaan, dan pembimbing lapangan.
- Export seluruh riwayat kegiatan pengguna ke PDF.
- Pagination untuk halaman riwayat kegiatan.

## Teknologi

- PHP 8.3+
- Laravel 13
- Laravel Breeze untuk autentikasi
- SQLite sebagai basis data bawaan
- Blade, Vite, Tailwind CSS, dan Alpine.js untuk antarmuka
- `barryvdh/laravel-dompdf` untuk pembuatan PDF
- PHPUnit untuk pengujian

## Prasyarat

Pastikan perangkat sudah memiliki:

- PHP 8.3 atau lebih baru
- Composer
- Node.js dan npm
- Ekstensi PHP SQLite (`pdo_sqlite`)

## Instalasi

1. Masuk ke folder proyek, lalu pasang dependensi PHP dan JavaScript.

   ```bash
   composer install
   npm install
   ```

2. Siapkan konfigurasi lingkungan dan application key.

   ```bash
   copy .env.example .env
   php artisan key:generate
   ```

   Di macOS/Linux, gunakan `cp .env.example .env`.

3. Proyek menggunakan SQLite secara bawaan. Pastikan file `database/database.sqlite` tersedia, lalu jalankan migrasi.

   ```bash
   php artisan migrate
   ```

4. (Opsional) Buat data pengguna contoh dari seeder.

   ```bash
   php artisan db:seed
   ```

   Seeder membuat pengguna dengan email `test@example.com` untuk kebutuhan pengembangan.

5. Jalankan aplikasi dan Vite pada dua terminal berbeda.

   ```bash
   php artisan serve
   ```

   ```bash
   npm run dev
   ```

   Buka alamat yang ditampilkan Laravel, biasanya `http://127.0.0.1:8000`.

Untuk menjalankan server, queue, log, dan Vite sekaligus, gunakan:

```bash
composer run dev
```

## Konfigurasi database MySQL (opsional)

Jika memakai Laragon/MySQL, buat database terlebih dahulu lalu ubah bagian database di `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=jurnal_pkl
DB_USERNAME=root
DB_PASSWORD=
```

Kemudian jalankan kembali:

```bash
php artisan migrate
```

## Penggunaan

1. Daftar atau masuk ke aplikasi.
2. Lengkapi **Data Tempat PKL** pada menu Profil agar informasi tersebut muncul di PDF.
3. Tekan **Isi Jurnal Hari Ini** atau **Tambah** untuk membuat kegiatan.
4. Buka **Riwayat Kegiatan** untuk mencari, memfilter, mengubah, atau menghapus jurnal.
5. Tekan **Export PDF** untuk mengunduh laporan seluruh kegiatan milik akun yang sedang masuk.

## Pengujian dan build

Jalankan test:

```bash
php artisan test
```

Build aset produksi:

```bash
npm run build
```

## Struktur penting

```text
app/
|- Http/Controllers/KegiatanController.php  # CRUD dan export PDF kegiatan
|- Models/Kegiatan.php                      # Model jurnal kegiatan
|- Models/User.php                           # Model pengguna dan data PKL
`- Rules/JamTidakBentrok.php                 # Validasi bentrok jam kegiatan
database/migrations/                          # Struktur tabel users dan kegiatans
resources/views/kegiatan/                     # Halaman jurnal dan template PDF
resources/views/profile/                      # Halaman profil dan data tempat PKL
routes/web.php                                # Rute aplikasi
tests/                                        # Test fitur dan unit
```

## Catatan

Setiap jurnal terhubung ke satu pengguna melalui `user_id`. Saat akun dihapus, kegiatan miliknya ikut terhapus melalui foreign key `cascadeOnDelete`.

## Lisensi

Proyek ini menggunakan lisensi MIT.
