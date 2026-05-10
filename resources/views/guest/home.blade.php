@extends('layouts.guest')
@section('title', 'Beranda — Wisata Medan')

@section('styles')
<style>
    .hero-guest {
        width: 100%;
        min-height: 85vh;
        background: url('{{ asset("images/userimage.jpg") }}') center/cover no-repeat;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .hero-guest::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(0,0,0,.45) 0%, rgba(0,0,0,.6) 100%);
    }
    .hero-guest-content {
        position: relative;
        z-index: 1;
        text-align: center;
        color: #fff;
        max-width: 700px;
        padding: 2rem;
    }
    .hero-guest-content h1 {
        font-size: 2.5rem;
        font-weight: 700;
        text-shadow: 0 2px 10px rgba(0,0,0,.4);
        margin-bottom: 1.25rem;
    }
    .hero-guest-content p {
        font-size: 1.05rem;
        line-height: 1.7;
        opacity: .9;
        margin-bottom: 2rem;
    }
    .btn-hero {
        background: #fff;
        color: #1a1a1a;
        font-weight: 700;
        padding: .75rem 2rem;
        border-radius: 30px;
        text-decoration: none;
        font-size: 1rem;
        transition: all .25s ease;
        display: inline-block;
    }
    .btn-hero:hover {
        background: #1a1a1d;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,.3);
    }
</style>
@endsection

@section('hero')
<div class="hero-guest">
    <div class="hero-guest-content">
        <h1>Selamat Datang di Sistem Pemilihan Destinasi Wisata Kota Medan</h1>
        <p>Temukan destinasi wisata terbaik di Kota Medan dengan sistem pemilihan berbasis AHP.
           Pilih destinasi sesuai preferensimu dan temukan pengalaman liburan yang luar biasa.</p>
        <a href="{{ route('guest.rating.index') }}" class="btn-hero">
            <i class="bi bi-star-fill me-1"></i> Beri Penilaian Sekarang
        </a>
    </div>
</div>
@endsection
