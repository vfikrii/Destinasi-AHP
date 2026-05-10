@extends('layouts.app')
@section('title', 'Kriteria')

@section('content')
<div class="card-ahp">
    <h2 class="section-header"><i class="bi bi-list-check"></i> Kriteria</h2>

    <div class="table-responsive">
        <table class="table table-ahp table-hover mb-0">
            <thead>
                <tr>
                    <th width="60">No</th>
                    <th>Nama Kriteria</th>
                    <th width="180">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kriteria as $i => $k)
                <tr id="row-{{ $k->id }}">
                    <td>{{ $i + 1 }}</td>
                    <td>
                        <span id="name-{{ $k->id }}">{{ $k->nama }}</span>
                        {{-- Inline edit form --}}
                        <div id="edit-form-{{ $k->id }}" class="d-none mt-1">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" id="edit-name-{{ $k->id }}" value="{{ $k->nama }}">
                                <button class="btn btn-success btn-sm" onclick="updateKriteria({{ $k->id }})">
                                    <i class="bi bi-check-lg"></i>
                                </button>
                                <button class="btn btn-secondary btn-sm" onclick="toggleEdit({{ $k->id }})">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                        </div>
                    </td>
                    <td>
                        <button class="btn btn-outline-primary btn-sm me-1" onclick="toggleEdit({{ $k->id }})">
                            <i class="bi bi-pencil"></i> Edit
                        </button>
                        <button class="btn btn-outline-danger btn-sm" onclick="deleteKriteria({{ $k->id }})">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center text-muted py-4">
                        <i class="bi bi-inbox fs-3 d-block mb-2"></i>Belum ada kriteria.
                    </td>
                </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">
                        <div class="d-flex gap-2">
                            <input type="text" class="form-control form-control-sm" id="new-kriteria-name"
                                   placeholder="Nama kriteria baru..." maxlength="20">
                            <button class="btn btn-primary btn-sm text-nowrap" onclick="addKriteria()">
                                <i class="bi bi-plus-lg me-1"></i>Tambah
                            </button>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="d-flex justify-content-end mt-3">
        <a href="{{ route('alternatif.index') }}" class="btn btn-primary">
            Lanjut <i class="bi bi-arrow-right ms-1"></i>
        </a>
    </div>
</div>
@endsection

@section('scripts')
<script>
function toggleEdit(id) {
    const form = document.getElementById('edit-form-' + id);
    const name = document.getElementById('name-' + id);
    form.classList.toggle('d-none');
    name.classList.toggle('d-none');
}

function addKriteria() {
    const name = document.getElementById('new-kriteria-name').value.trim();
    if (!name) { alert('Nama kriteria tidak boleh kosong.'); return; }

    fetch('{{ route("kriteria.store") }}', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest' },
        body: JSON.stringify({ name })
    })
    .then(r => r.json())
    .then(() => location.reload())
    .catch(() => alert('Gagal menambahkan kriteria.'));
}

function updateKriteria(id) {
    const name = document.getElementById('edit-name-' + id).value.trim();
    if (!name) { alert('Nama kriteria tidak boleh kosong.'); return; }

    fetch('/admin/kriteria/' + id, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest' },
        body: JSON.stringify({ name })
    })
    .then(r => r.json())
    .then(() => location.reload())
    .catch(() => alert('Gagal mengupdate kriteria.'));
}

function deleteKriteria(id) {
    if (!confirm('Apakah Anda yakin ingin menghapus kriteria ini?')) return;

    fetch('/admin/kriteria/' + id, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(r => r.json())
    .then(() => document.getElementById('row-' + id).remove())
    .catch(() => alert('Gagal menghapus kriteria.'));
}
</script>
@endsection
