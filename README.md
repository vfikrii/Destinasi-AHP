# Destinasi-AHP

Sistem Pendukung Keputusan Pemilihan Destinasi Wisata Kota Medan menggunakan metode **Analytic Hierarchy Process (AHP)**.

## Teknologi

- **Backend:** Laravel 11 (PHP 8.2+)
- **Frontend:** Blade Templates + Bootstrap 5.3
- **Database:** MySQL / MariaDB (InnoDB)
- **Font:** Inter (Google Fonts)
- **Icons:** Bootstrap Icons 1.11

## Instalasi

```bash
# 1. Clone & install dependencies
composer install

# 2. Konfigurasi environment
cp .env.example .env
php artisan key:generate

# 3. Sesuaikan .env (database)
# DB_DATABASE=destinasi_ahp
# DB_USERNAME=root
# DB_PASSWORD=

# 4. Import database
mysql -u root -p destinasi_ahp < db.sql

# 5. Jalankan server
php artisan serve
```

## Akun Default

| Role  | Username | Password |
|-------|----------|----------|
| Admin | `admin`  | `admin123` |
| Guest | `guest`  | `guest123` |

## Struktur Proyek

```
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php
│   │   │   ├── Admin/              ← CRUD + AHP Processing
│   │   │   └── Guest/              ← View-only
│   │   ├── Middleware/
│   │   │   └── CheckRole.php       ← Role-based access
│   │   └── Requests/               ← 9 Form Request validators
│   ├── Models/                     ← 9 Eloquent models
│   ├── Providers/
│   │   └── AppServiceProvider.php  ← View Composer
│   └── Services/
│       └── AhpCalculationService.php ← Business logic
├── bootstrap/
│   └── app.php                     ← Middleware registration
├── database/
│   └── migrations/                 ← 9 migration files
├── public/
│   └── images/                     ← ahp.jpg, userimage.jpg
├── resources/views/
│   ├── layouts/                    ← app.blade.php, guest.blade.php
│   ├── auth/                       ← login, register
│   ├── admin/                      ← 9 admin views
│   └── guest/                      ← 4 guest views
├── routes/
│   └── web.php
├── .env.example                    ← Template environment
├── .env                            ← Konfigurasi environment lokal
├── db.sql                          ← Database schema + seed
└── README.md
```

## Kelompok 2

- Fikri
- Shelmu
- Aqsal
