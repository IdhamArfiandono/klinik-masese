# MaSeSe Clinic Management System

Aplikasi manajemen klinik berbasis Laravel untuk mengelola dokter, pasien, apoteker, rekam medis, resep, dan transaksi farmasi.

## Fitur utama

- manajemen pengguna berdasarkan peran: admin, dokter, apoteker, pasien
- manajemen jadwal dan janji temu
- pembuatan dan penyimpanan rekam medis
- pembuatan resep dan resep obat
- transaksi dan item transaksi farmasi
- autentikasi dan kontrol akses per peran

## Struktur utama

- `app/Models` berisi model untuk pengguna, dokter, pasien, resep, transaksi, dan item transaksi
- `app/Http/Controllers` berisi logika kontrol aplikasi
- `database/migrations` berisi skema tabel database
- `database/seeders` berisi data awal untuk pengguna, dokter, pasien, dan transaksi
- `resources/views` berisi tampilan Blade untuk antarmuka pengguna

## Instalasi

1. Salin file lingkungan contoh:

    ```bash
    cp .env.example .env
    ```

2. Sesuaikan konfigurasi database pada `.env`.

3. Pasang dependensi PHP:

    ```bash
    composer install
    ```

4. Buat kunci aplikasi:

    ```bash
    php artisan key:generate
    ```

5. Jalankan migrasi dan seeder:

    ```bash
    php artisan migrate --seed
    ```

6. Jalankan server lokal:

    ```bash
    php artisan serve
    ```

## Penggunaan

- Akses aplikasi melalui browser pada `http://127.0.0.1:8000`
- Login dengan akun admin yang dibuat oleh seeder
- Kelola data dokter, pasien, apoteker, janji temu, rekam medis, resep, dan transaksi

## Data awal

Seeder `database/seeders/UserSeeder.php` mengisi data pengguna berikut:

- admin
- dokter umum
- dokter gigi
- apoteker
- pasien dummy

## Catatan

- Pastikan database sudah dibuat dan dapat diakses sebelum menjalankan migrasi.
- Jika diperlukan, sesuaikan pengaturan `APP_URL` dan pengaturan lainnya pada file `.env`.

## Lisensi

Proyek ini dapat digunakan dan dimodifikasi sesuai kebutuhan. Lisensi dasar mengikuti ketentuan MIT untuk paket Laravel yang digunakan.
