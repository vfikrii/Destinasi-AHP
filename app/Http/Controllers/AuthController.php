<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();
        $user = User::where('username', $validated['username'])->where('password', md5($validated['password']))->first();

        if (! $user || $user->role !== 'guest') {
            return back()->withInput($request->only('username'))->with('error', 'Username atau password salah, atau Anda bukan Guest!');
        }

        Auth::login($user);
        $request->session()->regenerate();
        return redirect()->route('guest.rating.index');
    }

    public function showAdminLoginForm()
    {
        return view('auth.admin-login');
    }

    public function adminLogin(LoginRequest $request)
    {
        $validated = $request->validated();
        $user = User::where('username', $validated['username'])->where('password', md5($validated['password']))->first();

        if (! $user || $user->role !== 'admin') {
            return back()->withInput($request->only('username'))->with('error', 'Kredensial salah atau Anda bukan Admin!');
        }

        Auth::login($user);
        $request->session()->regenerate();
        return redirect()->route('admin.dashboard');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        User::create([
            'username' => $validated['username'],
            'password' => md5($validated['password']),
            'email'    => $validated['email'],
        ]);

        return redirect()->route('login')
            ->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
