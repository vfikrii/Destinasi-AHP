<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Destinasi Wisata Medan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #212529 0%, #343a40 100%);
            margin: 0;
        }
        .auth-card {
            background: rgba(255,255,255,.1);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,.2);
            border-radius: 20px;
            padding: 2.5rem;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 16px 40px rgba(0,0,0,.25);
        }
        .auth-card h2 {
            color: #fff;
            font-weight: 700;
            font-size: 1.75rem;
            text-align: center;
            margin-bottom: 1.75rem;
        }
        .form-floating { margin-bottom: 1rem; }
        .form-floating .form-control {
            background: rgba(255,255,255,.12);
            border: 1px solid rgba(255,255,255,.25);
            border-radius: 12px;
            color: #fff;
            font-size: .9rem;
            padding-top: 1.5rem;
        }
        .form-floating .form-control:focus {
            background: rgba(255,255,255,.18);
            border-color: rgba(255,255,255,.5);
            box-shadow: 0 0 0 .2rem rgba(255,255,255,.1);
            color: #fff;
        }
        .form-floating .form-control::placeholder { color: transparent; }
        .form-floating label { color: rgba(255,255,255,.65); font-size: .85rem; }
        .btn-auth {
            width: 100%;
            padding: .75rem;
            background: #0d6efd;
            color: #fff;
            font-weight: 700;
            font-size: 1rem;
            border: none;
            border-radius: 12px;
            transition: all .25s ease;
        }
        .btn-auth:hover {
            background: #0b5ed7;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(13,110,253,.4);
        }
        .auth-link { color: rgba(255,255,255,.6); text-align: center; font-size: .85rem; }
        .auth-link a { color: #fff; font-weight: 600; text-decoration: none; }
        .auth-link a:hover { text-decoration: underline; }
        .alert-auth {
            background: rgba(244,67,54,.2);
            border: 1px solid rgba(244,67,54,.3);
            color: #ffcdd2;
            border-radius: 12px;
            font-size: .85rem;
        }
        .alert-success-auth {
            background: rgba(76,175,80,.2);
            border: 1px solid rgba(76,175,80,.3);
            color: #c8e6c9;
            border-radius: 12px;
            font-size: .85rem;
        }
        .desktop-hint {
            background: rgba(0,0,0,.2);
            border-radius: 10px;
            padding: .75rem;
            text-align: center;
            color: rgba(255,255,255,.75);
            font-size: .8rem;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="auth-card">
        <h2><i class="bi bi-person-circle me-2"></i>Login</h2>

        @if(session('error'))
            <div class="alert alert-auth mb-3">
                <i class="bi bi-exclamation-triangle me-1"></i> {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success-auth mb-3">
                <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-auth mb-3">
                @foreach($errors->all() as $error)
                    <div><i class="bi bi-x-circle me-1"></i> {{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ url('/login') }}">
            @csrf
            <div class="form-floating">
                <input type="text" class="form-control" id="username" name="username"
                       placeholder="Username" value="{{ old('username') }}" required autofocus>
                <label for="username"><i class="bi bi-person me-1"></i>Username</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="password" name="password"
                       placeholder="Password" required>
                <label for="password"><i class="bi bi-lock me-1"></i>Password</label>
            </div>
            <button type="submit" class="btn btn-auth mt-2">Login</button>
        </form>

        <p class="auth-link mt-3 mb-0">
            Belum punya akun? <a href="{{ route('register') }}">Register</a>
        </p>

        <div class="desktop-hint">
            <i class="bi bi-display me-1"></i>
            <strong>Gunakan Mode Desktop</strong> untuk hasil yang maksimal.
        </div>
    </div>
</body>
</html>
