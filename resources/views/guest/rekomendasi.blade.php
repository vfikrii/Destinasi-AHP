@extends('layouts.guest')
@section('title', 'Hasil Rekomendasi Personal')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
                <div class="card-header bg-primary text-white text-center py-4">
                    <h3 class="mb-0 fw-bold"><i class="bi bi-stars me-2"></i>Rekomendasi Personal Anda</h3>
                    <p class="mb-0 mt-2 opacity-75 small">Dihitung otomatis menggunakan algoritma AHP berdasarkan preferensi penilaian Anda.</p>
                </div>
                
                <div class="card-body p-0">
                    @if(empty($rankings))
                        <div class="text-center py-5">
                            <i class="bi bi-emoji-frown text-muted" style="font-size: 4rem;"></i>
                            <h4 class="mt-3">Anda belum merating tempat manapun!</h4>
                            <p class="text-muted">Silakan beri penilaian terlebih dahulu untuk mendapatkan rekomendasi.</p>
                            <a href="{{ route('guest.rating.index') }}" class="btn btn-primary mt-2">Beri Penilaian Sekarang</a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0 text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th class="py-3">Peringkat</th>
                                        <th class="py-3 text-start">Destinasi Wisata</th>
                                        <th class="py-3">Skor Kecocokan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rankings as $index => $rank)
                                        <tr class="{{ $index === 0 ? 'table-success' : '' }}">
                                            <td class="py-3">
                                                @if($index === 0)
                                                    <div class="badge bg-warning text-dark fs-6 px-3 py-2 rounded-pill shadow-sm">
                                                        <i class="bi bi-trophy-fill me-1"></i> #1 Terbaik
                                                    </div>
                                                @else
                                                    <span class="fs-5 fw-bold text-muted">#{{ $index + 1 }}</span>
                                                @endif
                                            </td>
                                            <td class="py-3 text-start fw-bold fs-5 {{ $index === 0 ? 'text-success' : 'text-dark' }}">
                                                {{ $rank['nama'] }}
                                            </td>
                                            <td class="py-3">
                                                <span class="badge bg-secondary px-3 py-2 fs-6 rounded-pill">
                                                    {{ number_format($rank['nilai'], 4) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
                @if(!empty($rankings))
                <div class="card-footer bg-light text-center py-3">
                    <a href="{{ route('guest.rating.index') }}" class="btn btn-outline-primary"><i class="bi bi-pencil-square me-2"></i>Ubah Penilaian Saya</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
