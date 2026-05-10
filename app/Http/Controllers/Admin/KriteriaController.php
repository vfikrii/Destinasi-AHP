<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKriteriaRequest;
use App\Http\Requests\UpdateBobotRequest;
use App\Http\Requests\UpdateKriteriaRequest;
use App\Models\Kriteria;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::orderBy('id')->get();

        return view('admin.kriteria.index', compact('kriteria'));
    }

    public function store(StoreKriteriaRequest $request): JsonResponse|RedirectResponse
    {
        Kriteria::create(['nama' => $request->validated('name')]);

        if ($request->ajax()) {
            return response()->json(['status' => 'success'], 201);
        }

        return redirect()->route('kriteria.index');
    }

    public function update(UpdateKriteriaRequest $request, int $id): JsonResponse|RedirectResponse
    {
        Kriteria::findOrFail($id)->update(['nama' => $request->validated('name')]);

        if ($request->ajax()) {
            return response()->json(['status' => 'success']);
        }

        return redirect()->route('kriteria.index');
    }

    /**
     * Hapus kriteria + semua data terkait dalam satu transaksi.
     * Foreign key CASCADE sudah menangani, tapi explicit delete sebagai safety net.
     */
    public function destroy(Request $request, int $id): JsonResponse|RedirectResponse
    {
        $kriteria = Kriteria::findOrFail($id);

        DB::transaction(function () use ($kriteria) {
            $kriteria->pvKriteria()?->delete();
            $kriteria->pvAlternatif()->delete();
            $kriteria->perbandinganSebagaiKriteria1()->delete();
            $kriteria->perbandinganSebagaiKriteria2()->delete();
            $kriteria->perbandinganAlternatif()->delete();
            $kriteria->delete();
        });

        if ($request->ajax()) {
            return response()->json(['status' => 'success']);
        }

        return redirect()->route('kriteria.index');
    }

    public function updateBobot(UpdateBobotRequest $request): JsonResponse
    {
        DB::transaction(function () use ($request) {
            foreach ($request->validated('bobot') as $kriteriaId => $nilaiBobot) {
                Kriteria::where('id', (int) $kriteriaId)
                    ->update(['bobot' => $nilaiBobot]);
            }
        });

        return response()->json([
            'status'  => 'success',
            'message' => 'Bobot berhasil disimpan',
        ]);
    }
}
