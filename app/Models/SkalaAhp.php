<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkalaAhp extends Model
{
    protected $table = 'skala_ahp';

    protected $fillable = [
        'nama_skala',
        'bintang',
        'nilai_ahp',
    ];

    protected $casts = [
        'bintang' => 'integer',
        'nilai_ahp' => 'float',
    ];
}
