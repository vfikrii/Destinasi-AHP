<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Rekomendasi Destinasi Wisata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2e7d32;
            --primary-dark: #1b5e20;
        }
        body {
            font-family: 'Inter', sans-serif;
            background: #f8f9fa;
        }
        .hero {
            background: linear-gradient(rgba(27, 94, 32, 0.8), rgba(0, 0, 0, 0.6)), url('{{ asset("images/userimage.jpg") }}') center/cover no-repeat;
            min-height: 100vh;
            display: flex;
            align-items: center;
            color: white;
            text-align: center;
        }
        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.5);
        }
        .hero-subtitle {
            font-size: 1.2rem;
            font-weight: 300;
            margin-bottom: 2rem;
            opacity: 0.9;
        }
        .btn-login {
            background-color: var(--primary);
            color: white;
            padding: 0.8rem 2.5rem;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 50px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s;
            border: 2px solid var(--primary);
        }
        .btn-login:hover {
            background-color: transparent;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(46, 125, 50, 0.4);
        }
    </style>
</head>
<body>

<div class="hero">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="hero-title">Rekomendasi Destinasi Wisata Kota Medan</h1>
                <p class="hero-subtitle">Temukan tempat wisata terbaik di Kota Medan berdasarkan penilaian dan rekomendasi pintar sistem AHP.</p>
                
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-login shadow-lg">
                            DASHBOARD ADMIN <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    @else
                        <a href="{{ route('guest.rating.index') }}" class="btn btn-login shadow-lg">
                            BERI PENILAIAN <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn btn-login shadow-lg">
                        LOGIN <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                @endauth
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
