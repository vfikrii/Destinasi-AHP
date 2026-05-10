<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProsesPerbandinganRequest;
use App\Http\Requests\StorePerbandinganKriteriaRequest;
use App\Models\Kriteria;
use App\Services\AhpCalculationService;

class PerbandinganKriteriaController extends Controller
{
    public function __construct(
        private readonly AhpCalculationService $ahpService
    ) {}

    public function index()
    {
        $kriteria = Kriteria::orderBy('id')->get();
        $perbandingan = $this->ahpService->getStoredKriteriaComparisons();

        return view('admin.perbandingan-kriteria.index', compact('kriteria', 'perbandingan'));
    }

    public function store(StorePerbandinganKriteriaRequest $request)
    {
        $validated = $request->validated();

        foreach ($validated['kriteria'] as $k1 => $row) {
            foreach ($row as $k2 => $value) {
                \App\Models\PerbandinganKriteria::updateOrCreate(
                    ['kriteria1' => (int) $k1, 'kriteria2' => (int) $k2],
                    ['nilai' => max((float) $value, 0.001)]
                );
            }
        }

        return redirect()->route('perbandingan-kriteria.index');
    }

    public function proses(ProsesPerbandinganRequest $request)
    {
        $kriteria = Kriteria::orderBy('id')->get();
        $n = $kriteria->count();
        $ids = $kriteria->pluck('id')->toArray();

        $result = $this->ahpService->processComparison($request->validated(), $n);

        $this->ahpService->savePerbandinganKriteria($ids, $result['matrik'], $n);
        $this->ahpService->savePvKriteria($ids, $result['pv']);

        return view('admin.perbandingan-kriteria.output', array_merge(
            $result,
            ['kriteria' => $kriteria, 'n' => $n]
        ));
    }
}
