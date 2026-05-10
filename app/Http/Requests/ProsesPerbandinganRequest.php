<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Kriteria;

/**
 * Validasi form perbandingan berpasangan (kriteria & alternatif).
 * Asal: proses.php — form dari fungsi showTabelPerbandingan()
 *
 * Validasi dinamis berdasarkan jumlah kriteria/alternatif:
 *   - pilih1..pilihN  → radio button (1 atau 2)
 *   - bobot1..bobotN  → angka 1-10 (skala AHP)
 *
 * Keamanan vs kode lama:
 * - Kode lama: langsung concat ke query → "$query = INSERT INTO ... VALUES ($nilai)"
 * - Laravel: semua input divalidasi + Eloquent parameterized query
 */
class ProsesPerbandinganRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Hitung jumlah pasangan perbandingan
        $jenis = $this->input('jenis', 'kriteria');

        if ($jenis === 'kriteria') {
            $n = Kriteria::count();
        } else {
            $n = \App\Models\Alternatif::count();
        }

        $jumlahPasangan = ($n * ($n - 1)) / 2;

        $rules = [
            'jenis' => ['required', 'string'],
        ];

        for ($i = 1; $i <= $jumlahPasangan; $i++) {
            $rules["pilih{$i}"] = ['required', 'in:1,2'];
            $rules["bobot{$i}"] = ['required', 'numeric', 'min:1', 'max:10'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'pilih*.required' => 'Pilihan perbandingan wajib diisi.',
            'pilih*.in'       => 'Pilihan harus bernilai 1 atau 2.',
            'bobot*.required' => 'Nilai bobot perbandingan wajib diisi.',
            'bobot*.numeric'  => 'Nilai bobot harus berupa angka.',
            'bobot*.min'      => 'Nilai bobot minimal 1.',
            'bobot*.max'      => 'Nilai bobot maksimal 10.',
        ];
    }
}
