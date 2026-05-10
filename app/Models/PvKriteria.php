<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PvKriteria extends Model
{
    /**
     * Tabel yang digunakan model ini.
     */
    protected $table = 'pv_kriteria';

    /**
     * Primary key bukan 'id', melainkan 'id_kriteria'.
     */
    protected $primaryKey = 'id_kriteria';

    /**
     * Primary key bukan auto-increment.
     */
    public $incrementing = false;

    /**
     * Kolom yang boleh diisi secara massal.
     */
    protected $fillable = [
        'id_kriteria',
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
     * Relasi ke kriteria (inverse one-to-one).
     */
    public function kriteria(): BelongsTo
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria', 'id');
    }
}
