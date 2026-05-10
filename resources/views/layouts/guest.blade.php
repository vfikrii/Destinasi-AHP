<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Destinasi Wisata Medan')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #2e7d32;
            --primary-light: #4caf50;
            --text: #1a1a1a;
            --surface: #f9f9f9;
            --shadow: 0 2px 12px rgba(0,0,0,.08);
            --radius: 12px;
            --transition: all .25s ease;
        }
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            background: var(--surface);
            color: var(--text);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .navbar-guest {
            background: #fff;
            box-shadow: var(--shadow);
            padding: .6rem 0;
            z-index: 1050;
        }
        .navbar-guest .navbar-brand {
            font-weight: 700;
            color: var(--primary) !important;
        }
        .navbar-guest .nav-link {
            color: #333 !important;
            font-weight: 500;
            font-size: .9rem;
            padding: .5rem .85rem !important;
            border-radius: 8px;
            transition: var(--transition);
        }
        .navbar-guest .nav-link:hover,
        .navbar-guest .nav-link.active {
            background: rgba(46,125,50,.08);
            color: var(--primary) !important;
        }
        .btn-logout-guest {
            background: none;
            border: 1px solid #ddd;
            color: #333;
            font-weight: 600;
            font-size: .85rem;
            padding: .4rem .85rem;
            border-radius: 8px;
            transition: var(--transition);
        }
        .btn-logout-guest:hover {
            background: #f0f0f0;
            color: #d32f2f;
            border-color: #d32f2f;
        }
        .footer-guest {
            background: #111;
            color: rgba(255,255,255,.6);
            text-align: center;
            padding: 1rem 0;
            font-size: .8rem;
            margin-top: auto;
        }
        .table-guest { border-radius: var(--radius); overflow: hidden; box-shadow: var(--shadow); }
        .table-guest thead th {
            background: var(--primary);
            color: #fff;
            font-weight: 600;
            font-size: .85rem;
            border: none;
            padding: .85rem;
        }
        .table-guest tbody td { padding: .75rem; font-size: .9rem; }
        .table-guest tbody tr:hover { background: #f0f7f0; }
        @yield('styles')
    </style>
</head>
<body>
    {{-- Navbar Guest --}}
    <nav class="navbar navbar-expand-lg navbar-guest sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('guest.rating.index') }}">
                <i class="bi bi-compass me-1"></i> Wisata Medan
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#guestNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="guestNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-1">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('guest.rating.*') ? 'active' : '' }}"
                           href="{{ route('guest.rating.index') }}">
                            <i class="bi bi-star me-1"></i>Beri Penilaian
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('guest.rekomendasi') ? 'active' : '' }}"
                           href="{{ route('guest.rekomendasi') }}">
                            <i class="bi bi-trophy me-1"></i>Hasil Rekomendasi
                        </a>
                    </li>
                    <li class="nav-item ms-lg-2">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-logout-guest btn-sm">
                                <i class="bi bi-box-arrow-right me-1"></i>Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('hero')

    <main class="flex-grow-1">
        @yield('content')
    </main>

    <footer class="footer-guest">
        <p class="mb-0">Copyright &copy; {{ date('Y') }} — Kelompok 2 &middot; Fikri Shelmu Aqsal</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
