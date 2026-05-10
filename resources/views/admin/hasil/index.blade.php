@extends('layouts.app')
@section('title', 'Hasil Rekomendasi AHP')

@section('content')
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0 fw-bold text-primary"><i class="bi bi-trophy me-2"></i>Laporan Hasil Rekomendasi AHP</h5>
    </div>
    <div class="card-body p-0">
        <ul class="nav nav-tabs px-3 pt-3" id="hasilTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="global-tab" data-bs-toggle="tab" data-bs-target="#global" type="button" role="tab">
                    <i class="bi bi-globe me-1"></i> Global Ranking
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="history-tab" data-bs-toggle="tab" data-bs-target="#history" type="button" role="tab">
                    <i class="bi bi-clock-history me-1"></i> Personal History
                </button>
            </li>
        </ul>
        
        <div class="tab-content p-4" id="hasilTabsContent">
            {{-- Tab Global Ranking --}}
            <div class="tab-pane fade show active" id="global" role="tabpanel">
                <div class="alert alert-info">
                    <strong>Global Ranking</strong> dihitung berdasarkan rata-rata penilaian Bintang dari seluruh Guest yang dikalikan dengan bobot Kriteria AHP saat ini.
                </div>
                
                @if(empty($globalRankings))
                    <div class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                        Belum ada Guest yang memberikan penilaian.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle text-center">
                            <thead class="table-light">
                                <tr>
                                    <th width="80">Peringkat</th>
                                    <th class="text-start">Nama Alternatif (Destinasi)</th>
                                    <th>Total Skor AHP</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($globalRankings as $index => $rank)
                                    <tr class="{{ $index === 0 ? 'table-success fw-bold' : '' }}">
                                        <td>
                                            @if($index === 0)
                                                <i class="bi bi-trophy-fill text-warning fs-5"></i> 1
                                            @else
                                                {{ $index + 1 }}
                                            @endif
                                        </td>
                                        <td class="text-start">{{ $rank['nama'] }}</td>
                                        <td>{{ number_format($rank['nilai'], 4) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            {{-- Tab Personal History --}}
            <div class="tab-pane fade" id="history" role="tabpanel">
                @if(empty($personalHistory))
                    <div class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                        Belum ada riwayat penilaian dari Guest.
                    </div>
                @else
                    <div class="accordion" id="accordionHistory">
                        @foreach($personalHistory as $idx => $history)
                            <div class="accordion-item mb-3 border rounded shadow-sm">
                                <h2 class="accordion-header">
                                    <button class="accordion-button {{ $idx === 0 ? '' : 'collapsed' }} bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $idx }}">
                                        <div class="d-flex justify-content-between w-100 pe-3">
                                            <span><i class="bi bi-person-circle me-2"></i> User: <strong>{{ $history['user']->username }}</strong></span>
                                            <span class="text-muted"><i class="bi bi-calendar me-1"></i> {{ $history['last_rated_at'] ? $history['last_rated_at']->format('d M Y, H:i') : '-' }}</span>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapse{{ $idx }}" class="accordion-collapse collapse {{ $idx === 0 ? 'show' : '' }}" data-bs-parent="#accordionHistory">
                                    <div class="accordion-body">
                                        <p class="small text-muted mb-3">Ini adalah rekomendasi personal untuk user <strong>{{ $history['user']->username }}</strong> berdasarkan tempat wisata yang ia beri rating.</p>
                                        <table class="table table-sm table-bordered text-center">
                                            <thead class="table-light">
                                                <tr>
                                                    <th width="80">Peringkat</th>
                                                    <th class="text-start">Destinasi</th>
                                                    <th>Skor Personal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($history['rankings'] as $rIdx => $rank)
                                                    <tr class="{{ $rIdx === 0 ? 'table-warning fw-bold' : '' }}">
                                                        <td>{{ $rIdx + 1 }}</td>
                                                        <td class="text-start">{{ $rank['nama'] }}</td>
                                                        <td>{{ number_format($rank['nilai'], 4) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
