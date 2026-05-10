<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Validasi update bobot kriteria via AJAX.
 * Asal: proses_bobot.php — UPDATE kriteria SET bobot = '$nilai_bobot' WHERE id = $kriteria_id
 *
 * Keamanan vs kode lama:
 * - Kode lama: hanya mysqli_real_escape_string(), rentan type juggling
 * - Laravel: validasi numerik ketat + Eloquent parameterized query
 */
class UpdateBobotRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'bobot'   => ['required', 'array'],
            'bobot.*' => ['required', 'numeric', 'min:0', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'bobot.required'      => 'Data bobot tidak ditemukan.',
            'bobot.array'         => 'Format data bobot tidak valid.',
            'bobot.*.required'    => 'Nilai bobot wajib diisi.',
            'bobot.*.numeric'     => 'Nilai bobot harus berupa angka.',
            'bobot.*.min'         => 'Nilai bobot minimal 0.',
            'bobot.*.max'         => 'Nilai bobot maksimal 100.',
        ];
    }
}
