@extends('layouts.app')
@section('title', 'Kelola Skala Penilaian')

@section('content')
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold text-primary"><i class="bi bi-star-half me-2"></i>Skala Penilaian Bintang -> AHP</h5>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="bi bi-plus-lg me-1"></i> Tambah Skala
        </button>
    </div>
    <div class="card-body">
        <p class="text-muted">Mapping ini digunakan untuk mengkonversi input Bintang (1-5) dari Guest menjadi nilai standar AHP (1-9) untuk proses kalkulasi Absolute Measurement.</p>
        
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Rating Bintang</th>
                        <th>Keterangan (Label)</th>
                        <th>Nilai AHP</th>
                        <th width="150" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($skala as $s)
                    <tr>
                        <td>
                            @for($i=1; $i<=$s->bintang; $i++)
                                <i class="bi bi-star-fill text-warning"></i>
                            @endfor
                            ({{ $s->bintang }})
                        </td>
                        <td class="fw-bold">{{ $s->nama_skala }}</td>
                        <td><span class="badge bg-success px-3">{{ $s->nilai_ahp }}</span></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $s->id }}">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <form action="{{ route('skala.destroy', $s->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus skala ini?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                    {{-- Modal Edit --}}
                    <div class="modal fade" id="editModal{{ $s->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <form action="{{ route('skala.update', $s->id) }}" method="POST" class="modal-content">
                                @csrf @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Skala</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label>Label / Keterangan</label>
                                        <input type="text" name="nama_skala" class="form-control" value="{{ $s->nama_skala }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Jumlah Bintang (1-5)</label>
                                        <input type="number" name="bintang" class="form-control" min="1" max="5" value="{{ $s->bintang }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Nilai Konversi AHP (1-9)</label>
                                        <input type="number" step="0.001" name="nilai_ahp" class="form-control" value="{{ $s->nilai_ahp }}" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">Belum ada data skala penilaian.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal Add --}}
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('skala.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Tambah Skala Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Label / Keterangan</label>
                    <input type="text" name="nama_skala" class="form-control" placeholder="Cth: Sangat Baik" required>
                </div>
                <div class="mb-3">
                    <label>Jumlah Bintang (1-5)</label>
                    <input type="number" name="bintang" class="form-control" min="1" max="5" required>
                </div>
                <div class="mb-3">
                    <label>Nilai Konversi AHP (1-9)</label>
                    <input type="number" step="0.001" name="nilai_ahp" class="form-control" placeholder="Cth: 9" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
