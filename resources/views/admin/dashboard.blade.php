@extends('layouts.app')
@section('title', 'Dashboard')

@section('styles')
<style>
    .hero-admin {
        background: url('{{ asset("images/ahp.jpg") }}') center/cover no-repeat;
        min-height: 75vh;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        border-radius: 0 0 24px 24px;
        overflow: hidden;
        margin: -2rem -12px 2rem;
        width: calc(100% + 24px);
    }
    .hero-admin::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(27,94,32,.6) 0%, rgba(0,0,0,.5) 100%);
    }
    .hero-content {
        position: relative;
        z-index: 1;
        text-align: center;
        color: #fff;
        padding: 2rem;
    }
    .hero-content h1 {
        font-size: 2.5rem;
        font-weight: 700;
        text-shadow: 0 2px 10px rgba(0,0,0,.4);
        margin-bottom: 1rem;
    }
    .hero-content p {
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto;
        opacity: .9;
    }
</style>
@endsection

@section('content')
<div class="hero-admin">
    <div class="hero-content">
        <h1><i class="bi bi-diagram-3-fill me-2"></i>Sistem Pendukung Keputusan</h1>
        <p>Analytic Hierarchy Process (AHP) — Pemilihan Destinasi Wisata Kota Medan</p>
    </div>
</div>
@endsection
