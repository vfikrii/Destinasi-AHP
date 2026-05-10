<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Validasi simpan perbandingan kriteria via form dropdown.
 * Asal: perbandingan_alternatif.php
 *   → REPLACE INTO perbandingan_kriteria (kriteria1, kriteria2, nilai)
 *
 * Keamanan vs kode lama:
 * - Kode lama: "$query = REPLACE INTO ... VALUES ('$k1', '$k2', '$value')" → SQL injection
 * - Laravel: validasi ketat + Eloquent updateOrCreate()
 */
class StorePerbandinganKriteriaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kriteria'       => ['required', 'array'],
            'kriteria.*'     => ['required', 'array'],
            'kriteria.*.*'   => ['required', 'numeric', 'min:0', 'max:9'],
        ];
    }

    public function messages(): array
    {
        return [
            'kriteria.required'       => 'Data perbandingan kriteria wajib diisi.',
            'kriteria.*.*.required'   => 'Semua nilai perbandingan wajib diisi.',
            'kriteria.*.*.numeric'    => 'Nilai perbandingan harus berupa angka.',
        ];
    }
}
