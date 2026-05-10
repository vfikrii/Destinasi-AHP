<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Validasi update kriteria.
 * Asal: kriteria.php (action=update) — UPDATE kriteria SET nama = '$name' WHERE id = $id
 */
class UpdateKriteriaRequest extends FormRequest
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
