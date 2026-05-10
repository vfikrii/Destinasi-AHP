@extends('layouts.app')
@section('title', 'Alternatif')

@section('content')
<div class="card-ahp">
    <h2 class="section-header"><i class="bi bi-geo-alt"></i> Alternatif</h2>

    <div class="table-responsive">
        <table class="table table-ahp table-hover mb-0">
            <thead>
                <tr>
                    <th width="60">No</th>
                    <th>Nama Alternatif</th>
                    <th width="180">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($alternatif as $i => $a)
                <tr id="row-{{ $a->id }}">
                    <td>{{ $i + 1 }}</td>
                    <td>
                        <span id="name-{{ $a->id }}">{{ $a->nama }}</span>
                        <div id="edit-form-{{ $a->id }}" class="d-none mt-1">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" id="edit-name-{{ $a->id }}" value="{{ $a->nama }}">
                                <button class="btn btn-success btn-sm" onclick="updateAlternatif({{ $a->id }})">
                                    <i class="bi bi-check-lg"></i>
                                </button>
                                <button class="btn btn-secondary btn-sm" onclick="toggleEdit({{ $a->id }})">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                        </div>
                    </td>
                    <td>
                        <button class="btn btn-outline-primary btn-sm me-1" onclick="toggleEdit({{ $a->id }})">
                            <i class="bi bi-pencil"></i> Edit
                        </button>
                        <button class="btn btn-outline-danger btn-sm" onclick="deleteAlternatif({{ $a->id }})">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center text-muted py-4">
                        <i class="bi bi-inbox fs-3 d-block mb-2"></i>Belum ada alternatif.
                    </td>
                </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">
                        <div class="d-flex gap-2">
                            <input type="text" class="form-control form-control-sm" id="new-alternatif-name"
                                   placeholder="Nama alternatif baru..." maxlength="50">
                            <button class="btn btn-primary btn-sm text-nowrap" onclick="addAlternatif()">
                                <i class="bi bi-plus-lg me-1"></i>Tambah
                            </button>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="d-flex justify-content-end mt-3">
        <a href="{{ route('perbandingan-kriteria.index') }}" class="btn btn-primary">
            Lanjut <i class="bi bi-arrow-right ms-1"></i>
        </a>
    </div>
</div>
@endsection

@section('scripts')
<script>
function toggleEdit(id) {
    document.getElementById('edit-form-' + id).classList.toggle('d-none');
    document.getElementById('name-' + id).classList.toggle('d-none');
}

function addAlternatif() {
    const name = document.getElementById('new-alternatif-name').value.trim();
    if (!name) { alert('Nama alternatif tidak boleh kosong.'); return; }

    fetch('{{ route("alternatif.store") }}', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest' },
        body: JSON.stringify({ name })
    }).then(r => r.json()).then(() => location.reload()).catch(() => alert('Gagal menambahkan.'));
}

function updateAlternatif(id) {
    const name = document.getElementById('edit-name-' + id).value.trim();
    if (!name) { alert('Nama tidak boleh kosong.'); return; }

    fetch('/admin/alternatif/' + id, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest' },
        body: JSON.stringify({ name })
    }).then(r => r.json()).then(() => location.reload()).catch(() => alert('Gagal mengupdate.'));
}

function deleteAlternatif(id) {
    if (!confirm('Yakin ingin menghapus alternatif ini?')) return;

    fetch('/admin/alternatif/' + id, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest' }
    }).then(r => r.json()).then(() => document.getElementById('row-' + id).remove()).catch(() => alert('Gagal menghapus.'));
}
</script>
@endsection
