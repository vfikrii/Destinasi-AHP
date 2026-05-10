<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PerbandinganKriteria extends Model
{
    /**
     * Tabel yang digunakan model ini.
     */
    protected $table = 'perbandingan_kriteria';

    /**
     * Kolom yang boleh diisi secara massal.
     */
    protected $fillable = [
        'kriteria1',
        'kriteria2',
        'nilai',
    ];

    /**
     * Casting tipe data.
     */
    protected $casts = [
        'nilai' => 'float',
    ];

    /* =============================================
     * RELASI
     * ============================================= */

    /**
     * Relasi ke kriteria sebagai kriteria1.
     */
    public function kriteriaFirst(): BelongsTo
    {
        return $this->belongsTo(Kriteria::class, 'kriteria1', 'id');
    }

    /**
     * Relasi ke kriteria sebagai kriteria2.
     */
    public function kriteriaSecond(): BelongsTo
    {
        return $this->belongsTo(Kriteria::class, 'kriteria2', 'id');
    }
}
