<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Validasi tambah kriteria.
 * Asal: kriteria.php (action=add) — INSERT INTO kriteria (nama) VALUES ('$name')
 *
 * Keamanan: Kode lama rentan SQL injection karena langsung concat string.
 * Laravel Eloquent::create() menggunakan parameterized query.
 */
class StoreKriteriaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:20'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama kriteria wajib diisi.',
            'name.max'      => 'Nama kriteria maksimal 20 karakter.',
        ];
    }
}
