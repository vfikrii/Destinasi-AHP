<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GuestRating;
use App\Models\User;
use App\Services\AhpCalculationService;

class HasilController extends Controller
{
    public function __construct(
        private readonly AhpCalculationService $ahpService
    ) {}

    public function index()
    {
        // 1. Hitung Global Ranking
        $global = $this->ahpService->calculateGlobalRanking();

        // 2. Ambil semua User Guest yang sudah merating
        $guests = User::where('role', 'guest')
            ->whereHas('guestRatings')
            ->with(['guestRatings' => function ($q) {
                // Untuk menampilkan tanggal input, kita ambil created_at terbaru dari rating user tersebut
                $q->latest()->limit(1);
            }])
            ->get();

        // Hitung personal ranking untuk setiap guest tersebut
        $personalHistory = [];
        foreach ($guests as $guest) {
            $lastRatingDate = $guest->guestRatings->first()?->created_at;
            $personal = $this->ahpService->calculatePersonalRanking($guest->id);
            
            $personalHistory[] = [
                'user' => $guest,
                'last_rated_at' => $lastRatingDate,
                'rankings' => $personal['rankings']
            ];
        }

        // Urutkan riwayat berdasarkan yang terbaru merating
        usort($personalHistory, function($a, $b) {
            $dateA = $a['last_rated_at'] ? $a['last_rated_at']->timestamp : 0;
            $dateB = $b['last_rated_at'] ? $b['last_rated_at']->timestamp : 0;
            return $dateB <=> $dateA; // DESC
        });

        return view('admin.hasil.index', [
            'globalRankings' => $global['rankings'],
            'kriteriaList' => $global['kriteriaList'],
            'personalHistory' => $personalHistory
        ]);
    }
}
