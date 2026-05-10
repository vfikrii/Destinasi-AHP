<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAlternatifRequest;
use App\Http\Requests\UpdateAlternatifRequest;
use App\Models\Alternatif;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlternatifController extends Controller
{
    public function index()
    {
        $alternatif = Alternatif::orderBy('id')->get();

        return view('admin.alternatif.index', compact('alternatif'));
    }

    public function store(StoreAlternatifRequest $request): JsonResponse|RedirectResponse
    {
        Alternatif::create(['nama' => $request->validated('name')]);

        if ($request->ajax()) {
            return response()->json(['status' => 'success'], 201);
        }

        return redirect()->route('alternatif.index');
    }

    public function update(UpdateAlternatifRequest $request, int $id): JsonResponse|RedirectResponse
    {
        Alternatif::findOrFail($id)->update(['nama' => $request->validated('name')]);

        if ($request->ajax()) {
            return response()->json(['status' => 'success']);
        }

        return redirect()->route('alternatif.index');
    }

    public function destroy(Request $request, int $id): JsonResponse|RedirectResponse
    {
        $alternatif = Alternatif::findOrFail($id);

        DB::transaction(function () use ($alternatif) {
            $alternatif->pvAlternatif()->delete();
            $alternatif->ranking()?->delete();
            $alternatif->perbandinganSebagaiAlternatif1()->delete();
            $alternatif->perbandinganSebagaiAlternatif2()->delete();
            $alternatif->delete();
        });

        if ($request->ajax()) {
            return response()->json(['status' => 'success']);
        }

        return redirect()->route('alternatif.index');
    }
}
