<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Validasi form registrasi.
 * Asal: register.php — INSERT INTO users (username, password, email)
 *
 * Keamanan vs kode lama:
 * - Kode lama: SQL injection rentan → "$sql = INSERT INTO users ... VALUES ('$username', ...)"
 * - Laravel: Eloquent parameterized query, otomatis aman dari SQL injection.
 * - Validasi password: min 8 char + 1 huruf kapital (dari validatePassword() JS asli).
 */
class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => ['required', 'string', 'max:50', 'unique:users,username', 'alpha_num'],
            'password' => ['required', 'string', 'min:8', 'regex:/[A-Z]/'],
            'email'    => ['required', 'email', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'username.required'  => 'Username wajib diisi.',
            'username.unique'    => 'Username sudah digunakan.',
            'username.alpha_num' => 'Username hanya boleh berisi huruf dan angka.',
            'username.max'       => 'Username maksimal 50 karakter.',
            'password.required'  => 'Password wajib diisi.',
            'password.min'       => 'Password minimal 8 karakter.',
            'password.regex'     => 'Password harus memiliki setidaknya satu huruf kapital.',
            'email.required'     => 'Email wajib diisi.',
            'email.email'        => 'Format email tidak valid.',
        ];
    }
}
