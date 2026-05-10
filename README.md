# Destinasi-AHP (Absolute Measurement Version)

Sistem Rekomendasi Pemilihan Destinasi Wisata Kota Medan menggunakan algoritma **Analytic Hierarchy Process (AHP) - Absolute Measurement (Rating Model)**.

Pada versi terbaru ini, sistem mengadopsi model AHP yang jauh lebih modern:
*   **User/Guest** hanya perlu memberikan rating Bintang (⭐1-5) untuk tempat-tempat yang pernah mereka kunjungi (tanpa perlu memusingkan perbandingan matriks yang rumit).
*   **Admin** melakukan konfigurasi bobot kriteria AHP dasar dan pemetaan skala konversi bintang.
*   Sistem menghitung **Personal Ranking** secara instan untuk tiap Guest dan merangkum **Global Ranking** berdasarkan rata-rata penilaian seluruh Guest.

## Teknologi

- **Backend:** Laravel 11 (PHP 8.2+)
- **Frontend:** Blade Templates + Bootstrap 5.3
- **Database:** MySQL / MariaDB
- **Font:** Inter (Google Fonts)
- **Icons:** Bootstrap Icons 1.11

## Panduan Instalasi (Terbaru)

Berbeda dengan versi lama, sistem ini sudah **sepenuhnya menggunakan fitur Migration dan Seeder dari Laravel**, sehingga instalasinya jauh lebih mudah (tidak perlu import `db.sql` secara manual).

```bash
# 1. Clone & install dependencies
composer install

# 2. Konfigurasi environment
cp .env.example .env
php artisan key:generate

# 3. Sesuaikan .env (Pastikan membuat database kosong bernama destinasi_ahp terlebih dahulu)
# DB_DATABASE=destinasi_ahp
# DB_USERNAME=root
# DB_PASSWORD=

# 4. Generate Database & Akun Default secara otomatis
php artisan migrate:fresh --seed

# 5. Jalankan server
php artisan serve
```

## Akun Default Terdaftar

Bisa langsung Anda gunakan setelah menjalankan perintah `--seed` di atas.

| Role  | URL Login | Username | Password |
|-------|----------|----------|----------|
| **Admin** | `http://127.0.0.1:8000/admin` | `admin`  | `admin123` |
| **Guest** | `http://127.0.0.1:8000/login` | `guest`  | `guest123` |

## Alur Kerja Sistem (Workflow)

1.  **Admin** masuk ke panel dan menginput **Kriteria Penilaian** (misal: Kebersihan, Keamanan).
2.  **Admin** menginput data **Alternatif / Destinasi Wisata**.
3.  **Admin** melakukan Perbandingan Kriteria (Pairwise) untuk mendapatkan *bobot* tiap kriteria.
4.  **Admin** mengatur Skala Penilaian AHP (Bintang 1 = AHP 1, Bintang 2 = AHP 3, dst).
5.  **Guest** mendaftar/login, lalu langsung mengisi Rating Bintang pada destinasi wisata.
6.  Guest langsung mendapatkan **Rekomendasi Personal**, sementara Admin memantau **Global Ranking** & Riwayat Personal Guest dari dasbor.

## Kelompok 2

- Fikri
- Shelmu
- Aqsal
