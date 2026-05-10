<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Kriteria extends Model
{
    protected $table = 'kriteria';

    protected $fillable = [
        'nama',
        'bobot',
    ];

    protected $casts = [
        'bobot' => 'float',
    ];

    public function pvKriteria(): HasOne
    {
        return $this->hasOne(PvKriteria::class, 'id_kriteria', 'id');
    }

    public function perbandinganSebagaiKriteria1(): HasMany
    {
        return $this->hasMany(PerbandinganKriteria::class, 'kriteria1', 'id');
    }

    public function perbandinganSebagaiKriteria2(): HasMany
    {
        return $this->hasMany(PerbandinganKriteria::class, 'kriteria2', 'id');
    }

    public function guestRatings(): HasMany
    {
        return $this->hasMany(GuestRating::class, 'kriteria_id', 'id');
    }
}
