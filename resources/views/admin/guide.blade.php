@extends('layouts.app')
@section('title', 'Guide')

@section('content')
<div class="card-ahp">
    <h2 class="section-header"><i class="bi bi-book"></i> Tata Cara Penggunaan Website</h2>
    <p class="text-muted mb-4">
        <strong>Web SPK Pemilihan Destinasi Kota Medan</strong> menggunakan algoritma AHP untuk
        mempermudah turis memilih lokasi wisata yang cocok dengan kriteria mereka.
    </p>
    <hr>

    <div class="accordion" id="guideAccordion">
        {{-- Step 1 --}}
        <div class="accordion-item border-0 mb-2">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#step1">
                    <span class="badge bg-success me-2">1</span> Halaman Kriteria
                </button>
            </h2>
            <div id="step1" class="accordion-collapse collapse show" data-bs-parent="#guideAccordion">
                <div class="accordion-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Klik tombol <strong>"Kriteria"</strong> pada navigation bar.</li>
                        <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Klik tombol <strong>"Tambah"</strong>.</li>
                        <li><i class="bi bi-check-circle text-success me-2"></i>Masukkan kriteria yang diinginkan.</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Step 2 --}}
        <div class="accordion-item border-0 mb-2">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#step2">
                    <span class="badge bg-success me-2">2</span> Halaman Alternatif
                </button>
            </h2>
            <div id="step2" class="accordion-collapse collapse" data-bs-parent="#guideAccordion">
                <div class="accordion-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Klik <strong>"Lanjut"</strong> atau tombol <strong>"Alternatif"</strong> pada navigation bar.</li>
                        <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Klik tombol <strong>"Tambah"</strong>.</li>
                        <li><i class="bi bi-check-circle text-success me-2"></i>Masukkan alternatif yang diinginkan.</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Step 3 --}}
        <div class="accordion-item border-0 mb-2">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#step3">
                    <span class="badge bg-success me-2">3</span> Perbandingan Kriteria
                </button>
            </h2>
            <div id="step3" class="accordion-collapse collapse" data-bs-parent="#guideAccordion">
                <div class="accordion-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Masukkan nilai perbandingan dari kriteria.</li>
                        <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Gunakan radio button dan up/down button.</li>
                        <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Klik <strong>"Submit"</strong> untuk memasukkan nilai.</li>
                        <li><i class="bi bi-check-circle text-success me-2"></i>Sistem menampilkan tabel matriks perbandingan dan nilai kriteria.</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Step 4 --}}
        <div class="accordion-item border-0 mb-2">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#step4">
                    <span class="badge bg-success me-2">4</span> Perbandingan Alternatif
                </button>
            </h2>
            <div id="step4" class="accordion-collapse collapse" data-bs-parent="#guideAccordion">
                <div class="accordion-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Masukkan nilai perbandingan dari alternatif sesuai tiap kriteria.</li>
                        <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Klik <strong>"Submit"</strong>.</li>
                        <li><i class="bi bi-check-circle text-success me-2"></i>Sistem menampilkan tabel perbandingan dan nilai alternatif.</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Step 5 --}}
        <div class="accordion-item border-0">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#step5">
                    <span class="badge bg-success me-2">5</span> Halaman Ranking
                </button>
            </h2>
            <div id="step5" class="accordion-collapse collapse" data-bs-parent="#guideAccordion">
                <div class="accordion-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Halaman menampilkan tabel hasil perhitungan dan pemeringkatan.</li>
                        <li><i class="bi bi-check-circle text-success me-2"></i>Peringkat teratas = alternatif dengan nilai total tertinggi.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
