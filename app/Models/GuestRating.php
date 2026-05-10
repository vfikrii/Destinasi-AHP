<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GuestRating extends Model
{
    protected $table = 'guest_ratings';

    protected $fillable = [
        'user_id',
        'alternatif_id',
        'kriteria_id',
        'rating_bintang',
    ];

    protected $casts = [
        'rating_bintang' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function alternatif(): BelongsTo
    {
        return $this->belongsTo(Alternatif::class);
    }

    public function kriteria(): BelongsTo
    {
        return $this->belongsTo(Kriteria::class);
    }
}
