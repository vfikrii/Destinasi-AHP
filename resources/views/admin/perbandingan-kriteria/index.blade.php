@extends('layouts.app')
@section('title', 'Perbandingan Kriteria')

@section('content')
<div class="card-ahp">
    <h2 class="section-header"><i class="bi bi-arrow-left-right"></i> Perbandingan Kriteria</h2>

    <form action="{{ route('perbandingan-kriteria.proses') }}" method="POST">
        @csrf
        <input type="hidden" name="jenis" value="kriteria">

        <div class="table-responsive">
            <table class="table table-ahp table-hover mb-0">
                <thead>
                    <tr>
                        <th colspan="2">Pilih yang lebih penting</th>
                        <th width="200">Nilai Perbandingan</th>
                    </tr>
                </thead>
                <tbody>
                    @php $urut = 0; @endphp
                    @for($x = 0; $x <= $kriteria->count() - 2; $x++)
                        @for($y = $x + 1; $y <= $kriteria->count() - 1; $y++)
                            @php
                                $urut++;
                                $k1Id = $kriteria[$x]->id;
                                $k2Id = $kriteria[$y]->id;
                                $nilai = $perbandingan[$k1Id][$k2Id] ?? 1;
                            @endphp
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="pilih{{ $urut }}" value="1" checked>
                                        <label class="form-check-label fw-medium">{{ $kriteria[$x]->nama }}</label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="pilih{{ $urut }}" value="2">
                                        <label class="form-check-label fw-medium">{{ $kriteria[$y]->nama }}</label>
                                    </div>
                                </td>
                                <td>
                                    <input type="number" class="form-control form-control-sm text-center"
                                           name="bobot{{ $urut }}" value="{{ $nilai }}" min="1" max="10" required>
                                </td>
                            </tr>
                        @endfor
                    @endfor
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-3">
            <button type="submit" class="btn btn-primary px-4">
                <i class="bi bi-calculator me-1"></i> Hitung
            </button>
        </div>
    </form>
</div>
@endsection
