<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Validasi tambah alternatif.
 * Asal: alternatif.php (action=add) — INSERT INTO alternatif (nama) VALUES ('$name')
 */
class StoreAlternatifRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama alternatif wajib diisi.',
            'name.max'      => 'Nama alternatif maksimal 50 karakter.',
        ];
    }
}
