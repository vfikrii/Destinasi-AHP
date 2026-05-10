@extends('layouts.guest')
@section('title', 'Beri Penilaian')

@section('styles')
<style>
    .rating-card {
        background: #fff;
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border-left: 5px solid var(--primary);
    }
    .place-title {
        font-weight: 700;
        color: var(--primary-dark);
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #eee;
    }
    .star-rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: flex-end;
        gap: 0.2rem;
    }
    .star-rating input {
        display: none;
    }
    .star-rating label {
        font-size: 1.5rem;
        color: #ddd;
        cursor: pointer;
        transition: color 0.2s;
    }
    .star-rating input:checked ~ label,
    .star-rating label:hover,
    .star-rating label:hover ~ label {
        color: #ffc107;
    }
    .kriteria-row {
        margin-bottom: 0.5rem;
        align-items: center;
    }
    .kriteria-name {
        font-weight: 500;
    }
</style>
@endsection

@section('content')
<div class="container py-4">
    <div class="mb-4">
        <h2 class="fw-bold">Beri Penilaian Destinasi</h2>
        <p class="text-muted">Silakan beri rating pada tempat wisata yang <strong>pernah Anda kunjungi</strong>. Biarkan kosong jika Anda belum pernah ke tempat tersebut.</p>
    </div>

    @if($skalaMapping->isEmpty())
        <div class="alert alert-warning">
            Admin belum mengatur Skala Penilaian. Anda tidak bisa memberikan rating saat ini.
        </div>
    @else
        <form action="{{ route('guest.rating.store') }}" method="POST">
            @csrf

            <div class="row">
                @foreach($alternatifList as $alt)
                <div class="col-md-6 mb-3">
                    <div class="rating-card">
                        <h4 class="place-title"><i class="bi bi-geo-alt-fill me-2 text-danger"></i>{{ $alt->nama }}</h4>
                        
                        @foreach($kriteriaList as $krit)
                            @php
                                $val = $myRatings[$alt->id][$krit->id] ?? 0;
                            @endphp
                            <div class="row kriteria-row">
                                <div class="col-sm-5 kriteria-name">
                                    {{ $krit->nama }}
                                </div>
                                <div class="col-sm-7">
                                    <div class="star-rating">
                                        @for($i = 5; $i >= 1; $i--)
                                            <input type="radio" 
                                                   id="star{{ $alt->id }}_{{ $krit->id }}_{{ $i }}" 
                                                   name="ratings[{{ $alt->id }}][{{ $krit->id }}]" 
                                                   value="{{ $i }}" 
                                                   {{ $val == $i ? 'checked' : '' }}>
                                            <label for="star{{ $alt->id }}_{{ $krit->id }}_{{ $i }}"><i class="bi bi-star-fill"></i></label>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="text-end mt-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="clearRating({{ $alt->id }})">Clear Rating</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="text-center mt-4 mb-5">
                <button type="submit" class="btn btn-primary btn-lg px-5 shadow">
                    <i class="bi bi-save me-2"></i> Simpan Penilaian & Lihat Rekomendasi
                </button>
            </div>
        </form>
    @endif
</div>
@endsection

@section('scripts')
<script>
function clearRating(altId) {
    const inputs = document.querySelectorAll(`input[name^="ratings[${altId}]"]`);
    inputs.forEach(input => {
        input.checked = false;
    });
}
</script>
@endsection
