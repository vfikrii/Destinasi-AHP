@extends('layouts.app')
@section('title', 'Hasil Perbandingan Kriteria')

@section('content')
{{-- Matriks Perbandingan Berpasangan --}}
<div class="card-ahp">
    <h3 class="section-header"><i class="bi bi-grid-3x3"></i> Matriks Perbandingan Berpasangan</h3>
    <div class="table-responsive">
        <table class="table table-ahp table-bordered text-center mb-0">
            <thead>
                <tr>
                    <th>Kriteria</th>
                    @for($i = 0; $i < $n; $i++)
                        <th>{{ $kriteria[$i]->nama }}</th>
                    @endfor
                </tr>
            </thead>
            <tbody>
                @for($x = 0; $x < $n; $x++)
                <tr>
                    <td class="fw-semibold">{{ $kriteria[$x]->nama }}</td>
                    @for($y = 0; $y < $n; $y++)
                        <td>{{ round($matrik[$x][$y], 5) }}</td>
                    @endfor
                </tr>
                @endfor
            </tbody>
            <tfoot>
                <tr class="table-secondary">
                    <th>Jumlah</th>
                    @for($i = 0; $i < $n; $i++)
                        <th>{{ round($jmlmpb[$i], 5) }}</th>
                    @endfor
                </tr>
            </tfoot>
        </table>
    </div>
</div>

{{-- Matriks Nilai Kriteria --}}
<div class="card-ahp">
    <h3 class="section-header"><i class="bi bi-table"></i> Matriks Nilai Kriteria</h3>
    <div class="table-responsive">
        <table class="table table-ahp table-bordered text-center mb-0">
            <thead>
                <tr>
                    <th>Kriteria</th>
                    @for($i = 0; $i < $n; $i++)
                        <th>{{ $kriteria[$i]->nama }}</th>
                    @endfor
                    <th>Jumlah</th>
                    <th class="bg-warning text-dark">Priority Vector</th>
                </tr>
            </thead>
            <tbody>
                @for($x = 0; $x < $n; $x++)
                <tr>
                    <td class="fw-semibold">{{ $kriteria[$x]->nama }}</td>
                    @for($y = 0; $y < $n; $y++)
                        <td>{{ round($matrikb[$x][$y], 5) }}</td>
                    @endfor
                    <td>{{ round($jmlmnk[$x], 5) }}</td>
                    <td class="fw-bold text-success">{{ round($pv[$x], 5) }}</td>
                </tr>
                @endfor
            </tbody>
            <tfoot>
                <tr class="table-secondary">
                    <th colspan="{{ $n + 2 }}">Principe Eigen Vector (λ maks)</th>
                    <th>{{ round($eigenvektor, 5) }}</th>
                </tr>
                <tr class="table-secondary">
                    <th colspan="{{ $n + 2 }}">Consistency Index</th>
                    <th>{{ round($consIndex, 5) }}</th>
                </tr>
                <tr class="{{ $consRatio > 0.1 ? 'table-danger' : 'table-success' }}">
                    <th colspan="{{ $n + 2 }}">Consistency Ratio</th>
                    <th>{{ round($consRatio * 100, 2) }} %</th>
                </tr>
            </tfoot>
        </table>
    </div>

    @if($consRatio > 0.1)
        <div class="alert alert-danger mt-3 d-flex align-items-center">
            <i class="bi bi-exclamation-triangle-fill fs-4 me-2"></i>
            <div>
                <strong>Consistency Ratio melebihi 10%!</strong><br>
                Mohon input kembali tabel perbandingan.
            </div>
        </div>
        <a href="javascript:history.back()" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
    @else
        <div class="d-flex justify-content-end mt-3">
            <a href="{{ route('skala.index') }}" class="btn btn-primary">
                Lanjut ke Pengaturan Skala <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
    @endif
</div>
@endsection
