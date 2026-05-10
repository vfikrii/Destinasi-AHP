<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register — Destinasi Wisata Medan</title>
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
            background: linear-gradient(135deg, #1b5e20 0%, #2e7d32 40%, #388e3c 100%);
            margin: 0;
        }
        .auth-card {
            background: rgba(255,255,255,.12);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,.2);
            border-radius: 20px;
            padding: 2.5rem;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 16px 40px rgba(0,0,0,.25);
        }
        .auth-card h2 { color: #fff; font-weight: 700; font-size: 1.75rem; text-align: center; margin-bottom: 1.75rem; }
        .form-floating { margin-bottom: 1rem; }
        .form-floating .form-control {
            background: rgba(255,255,255,.12);
            border: 1px solid rgba(255,255,255,.25);
            border-radius: 12px;
            color: #fff;
            font-size: .9rem;
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
            background: #fff;
            color: #1b5e20;
            font-weight: 700;
            border: none;
            border-radius: 12px;
            transition: all .25s ease;
        }
        .btn-auth:hover { background: #e8f5e9; transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0,0,0,.15); color: #1b5e20; }
        .auth-link { color: rgba(255,255,255,.8); text-align: center; font-size: .9rem; }
        .auth-link a { color: #fff; font-weight: 600; text-decoration: none; }
        .auth-link a:hover { text-decoration: underline; }
        .alert-auth { background: rgba(244,67,54,.2); border: 1px solid rgba(244,67,54,.3); color: #ffcdd2; border-radius: 12px; font-size: .85rem; }
        .form-hint { color: rgba(255,255,255,.5); font-size: .75rem; margin-top: .25rem; }
    </style>
</head>
<body>
    <div class="auth-card">
        <h2><i class="bi bi-person-plus me-2"></i>Register</h2>

        @if($errors->any())
            <div class="alert alert-auth mb-3">
                @foreach($errors->all() as $error)
                    <div><i class="bi bi-x-circle me-1"></i> {{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register.process') }}">
            @csrf
            <div class="form-floating">
                <input type="text" class="form-control" id="username" name="username"
                       placeholder="Username" value="{{ old('username') }}" required>
                <label for="username"><i class="bi bi-person me-1"></i>Username</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="password" name="password"
                       placeholder="Password" required>
                <label for="password"><i class="bi bi-lock me-1"></i>Password</label>
                <div class="form-hint">Min. 8 karakter, 1 huruf kapital</div>
            </div>
            <div class="form-floating">
                <input type="email" class="form-control" id="email" name="email"
                       placeholder="Email" value="{{ old('email') }}" required>
                <label for="email"><i class="bi bi-envelope me-1"></i>Email</label>
            </div>
            <button type="submit" class="btn btn-auth mt-2">Register</button>
        </form>

        <p class="auth-link mt-3 mb-0">
            Sudah punya akun? <a href="{{ route('login') }}">Login</a>
        </p>
    </div>
</body>
</html>
