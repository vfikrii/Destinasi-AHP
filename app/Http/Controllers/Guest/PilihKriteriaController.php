<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Services\AhpCalculationService;

class PilihKriteriaController extends Controller
{
    public function __construct(
        private readonly AhpCalculationService $ahpService
    ) {}

    public function index()
    {
        return view('guest.pilih-kriteria', $this->ahpService->calculateFinalRanking());
    }

    public function hasil()
    {
        return view('guest.hasil', $this->ahpService->calculateFinalRanking());
    }
}
