@extends('layouts.guest')
@section('title', 'Hasil Perhitungan')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold text-center mb-4">
        <i class="bi bi-calculator text-success me-2"></i>Hasil Perhitungan
    </h2>

    <div class="table-responsive mb-5">
        <table class="table table-guest table-bordered text-center">
            <thead>
                <tr>
                    <th>Kriteria</th>
                    <th>Priority Vector</th>
                    @foreach($alternatifList as $alt)
                        <th>{{ $alt->nama }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($kriteriaList as $krit)
                <tr>
                    <td class="fw-semibold">{{ $krit->nama }}</td>
                    <td>{{ round($krit->pvKriteria?->nilai ?? 0, 5) }}</td>
                    @foreach($alternatifList as $alt)
                        <td>{{ round($alt->pvAlternatif->where('id_kriteria', $krit->id)->first()?->nilai ?? 0, 5) }}</td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="table-success">
                    <th colspan="2">Total</th>
                    @foreach($nilai as $n)
                        <th>{{ round($n, 5) }}</th>
                    @endforeach
                </tr>
            </tfoot>
        </table>
    </div>

    <h2 class="fw-bold text-center mb-4"><i class="bi bi-trophy text-success me-2"></i>Perangkingan</h2>
    <div class="table-responsive">
        <table class="table table-guest table-hover">
            <thead>
                <tr>
                    <th width="100">Peringkat</th>
                    <th>Alternatif</th>
                    <th>Nilai Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ranking as $i => $row)
                <tr class="{{ $i === 0 ? 'table-warning' : '' }}">
                    <td>
                        @if($i === 0)
                            <span class="badge bg-warning text-dark fs-6"><i class="bi bi-trophy-fill me-1"></i>1</span>
                        @else
                            <span class="badge bg-secondary">{{ $i + 1 }}</span>
                        @endif
                    </td>
                    <td class="fw-semibold">{{ $row->nama }}</td>
                    <td class="fw-bold text-success">{{ round($row->ranking_nilai, 5) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
