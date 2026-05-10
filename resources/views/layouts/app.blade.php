<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'DSS | AHP') — Destinasi Wisata Medan</title>

    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #2e7d32;
            --primary-light: #4caf50;
            --primary-dark: #1b5e20;
            --accent: #ffeb3b;
            --surface: #f8faf8;
            --text: #1a1a1a;
            --text-muted: #6b7280;
            --border: #e0e0e0;
            --shadow: 0 2px 12px rgba(0,0,0,.08);
            --shadow-lg: 0 8px 30px rgba(0,0,0,.12);
            --radius: 12px;
            --transition: all .25s ease;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--surface);
            color: var(--text);
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── Navbar Admin ── */
        .navbar-admin {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-light));
            box-shadow: var(--shadow);
            padding: .75rem 0;
            position: relative;
            z-index: 1050;
        }
        .navbar-admin .navbar-brand {
            font-weight: 700;
            font-size: 1.35rem;
            color: #fff !important;
            letter-spacing: .5px;
        }
        .navbar-admin .nav-link {
            color: rgba(255,255,255,.85) !important;
            font-weight: 500;
            font-size: .9rem;
            padding: .5rem .9rem !important;
            border-radius: 8px;
            transition: var(--transition);
        }
        .navbar-admin .nav-link:hover,
        .navbar-admin .nav-link.active {
            color: #fff !important;
            background: rgba(255,255,255,.15);
        }
        .navbar-admin .dropdown-menu {
            border: none;
            border-radius: var(--radius);
            box-shadow: var(--shadow-lg);
            padding: .5rem;
        }
        .navbar-admin .dropdown-item {
            border-radius: 8px;
            padding: .5rem .75rem;
            font-size: .875rem;
            transition: var(--transition);
        }
        .navbar-admin .dropdown-item:hover {
            background-color: var(--primary-light);
            color: #fff;
        }
        .navbar-admin .btn-logout {
            border: 1px solid rgba(255,255,255,.4);
            color: #fff;
            font-weight: 500;
            font-size: .875rem;
            border-radius: 8px;
            padding: .4rem .9rem;
            transition: var(--transition);
        }
        .navbar-admin .btn-logout:hover {
            background: rgba(255,255,255,.2);
            border-color: #fff;
            color: #fff;
        }

        /* ── Content ── */
        .content-wrapper {
            flex: 1;
            padding: 2rem 0;
        }

        /* ── Card ── */
        .card-ahp {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 1.75rem;
            margin-bottom: 1.5rem;
        }

        /* ── Table ── */
        .table-ahp {
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow);
        }
        .table-ahp thead th {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            color: #fff;
            font-weight: 600;
            font-size: .85rem;
            text-transform: uppercase;
            letter-spacing: .5px;
            border: none;
            padding: .85rem;
        }
        .table-ahp tbody td {
            padding: .75rem .85rem;
            font-size: .9rem;
            vertical-align: middle;
            border-color: var(--border);
        }
        .table-ahp tbody tr:hover {
            background-color: #f0f7f0;
        }

        /* ── Buttons ── */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border: none;
            border-radius: 8px;
            font-weight: 600;
            padding: .5rem 1.25rem;
            transition: var(--transition);
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(46,125,50,.3);
        }

        /* ── Section Header ── */
        .section-header {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-dark);
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: .5rem;
        }
        .section-header i {
            font-size: 1.3rem;
        }

        /* ── Footer ── */
        .footer-ahp {
            background: var(--text);
            color: rgba(255,255,255,.7);
            text-align: center;
            padding: 1rem 0;
            font-size: .8rem;
            margin-top: auto;
        }

        /* ── Alerts ── */
        .alert { border-radius: var(--radius); border: none; }

        @yield('styles')
    </style>
</head>
<body>
    {{-- Navbar Admin --}}
    <nav class="navbar navbar-expand-lg navbar-admin">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-diagram-3-fill me-1"></i> AHP
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav">
                <i class="bi bi-list text-white" style="font-size:1.5rem"></i>
            </button>
            <div class="collapse navbar-collapse" id="adminNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-1">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                           href="{{ route('admin.dashboard') }}">
                            <i class="bi bi-house-door me-1"></i>Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.guide') ? 'active' : '' }}"
                           href="{{ route('admin.guide') }}">
                            <i class="bi bi-book me-1"></i>Guide
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('kriteria.*') ? 'active' : '' }}"
                           href="{{ route('kriteria.index') }}">Kriteria</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('alternatif.*') ? 'active' : '' }}"
                           href="{{ route('alternatif.index') }}">Alternatif</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('perbandingan-kriteria.*') ? 'active' : '' }}"
                           href="{{ route('perbandingan-kriteria.index') }}">Perb. Kriteria</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('skala.*') ? 'active' : '' }}"
                           href="{{ route('skala.index') }}">Skala Penilaian</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('hasil.*') ? 'active' : '' }}"
                           href="{{ route('hasil.index') }}">
                            <i class="bi bi-trophy me-1"></i>Ranking
                        </a>
                    </li>

                    <li class="nav-item ms-lg-2">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-logout btn-sm">
                                <i class="bi bi-box-arrow-right me-1"></i>Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Flash Messages --}}
    <div class="container mt-3">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-1"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
    </div>

    {{-- Main Content --}}
    <main class="content-wrapper">
        <div class="container">
            @yield('content')
        </div>
    </main>

    {{-- Footer --}}
    <footer class="footer-ahp">
        <p class="mb-0">Copyright &copy; {{ date('Y') }} — Kelompok 2 &middot; Fikri Shelmu Aqsal</p>
    </footer>

    {{-- Bootstrap 5 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- CSRF for AJAX --}}
    <script>
        window.csrfToken = '{{ csrf_token() }}';
    </script>

    @yield('scripts')
</body>
</html>
