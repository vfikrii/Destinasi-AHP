<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Services\AhpCalculationService;
use Illuminate\Support\Facades\Auth;

class RekomendasiController extends Controller
{
    public function __construct(
        private readonly AhpCalculationService $ahpService
    ) {}

    public function index()
    {
        $userId = Auth::id();
        $personal = $this->ahpService->calculatePersonalRanking($userId);
        
        return view('guest.rekomendasi', [
            'rankings' => $personal['rankings']
        ]);
    }
}
