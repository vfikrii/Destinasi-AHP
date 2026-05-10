<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Alternatif;
use App\Models\GuestRating;
use App\Models\Kriteria;
use App\Models\SkalaAhp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RatingController extends Controller
{
    public function index()
    {
        $alternatifList = Alternatif::orderBy('id')->get();
        $kriteriaList = Kriteria::orderBy('id')->get();
        $skalaMapping = SkalaAhp::orderBy('bintang')->get();
        
        // Ambil rating user ini sebelumnya jika ada
        $userRatings = GuestRating::where('user_id', Auth::id())->get();
        
        $myRatings = [];
        foreach ($userRatings as $r) {
            $myRatings[$r->alternatif_id][$r->kriteria_id] = $r->rating_bintang;
        }

        return view('guest.beri-rating', compact('alternatifList', 'kriteriaList', 'skalaMapping', 'myRatings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ratings' => 'array',
            'ratings.*.*' => 'integer|min:1|max:5' // ratings[alternatif_id][kriteria_id] = bintang
        ]);

        $ratings = $request->input('ratings', []);
        $userId = Auth::id();

        DB::transaction(function () use ($userId, $ratings) {
            // Hapus yang lama untuk update bersih
            GuestRating::where('user_id', $userId)->delete();

            foreach ($ratings as $altId => $kritData) {
                foreach ($kritData as $kritId => $bintang) {
                    GuestRating::create([
                        'user_id' => $userId,
                        'alternatif_id' => $altId,
                        'kriteria_id' => $kritId,
                        'rating_bintang' => $bintang,
                    ]);
                }
            }
        });

        return redirect()->route('guest.rekomendasi')->with('success', 'Penilaian Anda berhasil disimpan! Berikut adalah rekomendasi personal Anda.');
    }
}
