<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ir extends Model
{
    /**
     * Tabel yang digunakan model ini.
     */
    protected $table = 'ir';

    /**
     * Primary key bukan 'id', melainkan 'jumlah'.
     */
    protected $primaryKey = 'jumlah';

    /**
     * Primary key bukan auto-increment.
     */
    public $incrementing = false;

    /**
     * Tabel ini tidak memiliki timestamps.
     */
    public $timestamps = false;

    /**
     * Kolom yang boleh diisi secara massal.
     */
    protected $fillable = [
        'jumlah',
        'nilai',
    ];

    /**
     * Casting tipe data.
     */
    protected $casts = [
        'jumlah' => 'integer',
        'nilai'  => 'float',
    ];
}
