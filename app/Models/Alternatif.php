<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Alternatif extends Model
{
    protected $table = 'alternatif';

    protected $fillable = [
        'nama',
    ];

    public function guestRatings(): HasMany
    {
        return $this->hasMany(GuestRating::class, 'alternatif_id', 'id');
    }
}
