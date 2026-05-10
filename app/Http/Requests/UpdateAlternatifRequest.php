<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Validasi update alternatif.
 * Asal: alternatif.php (action=update) — UPDATE alternatif SET nama = '$name' WHERE id = $id
 */
class UpdateAlternatifRequest extends FormRequest
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
