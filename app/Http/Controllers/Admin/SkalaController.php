<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SkalaAhp;
use Illuminate\Http\Request;

class SkalaController extends Controller
{
    public function index()
    {
        $skala = SkalaAhp::orderBy('bintang')->get();
        return view('admin.skala.index', compact('skala'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_skala' => 'required|string|max:50',
            'bintang' => 'required|integer|min:1|max:5|unique:skala_ahp,bintang',
            'nilai_ahp' => 'required|numeric|min:0.001',
        ]);

        SkalaAhp::create($validated);
        return redirect()->route('skala.index')->with('success', 'Skala berhasil ditambahkan.');
    }

    public function update(Request $request, SkalaAhp $skala)
    {
        $validated = $request->validate([
            'nama_skala' => 'required|string|max:50',
            'bintang' => 'required|integer|min:1|max:5|unique:skala_ahp,bintang,' . $skala->id,
            'nilai_ahp' => 'required|numeric|min:0.001',
        ]);

        $skala->update($validated);
        return redirect()->route('skala.index')->with('success', 'Skala berhasil diperbarui.');
    }

    public function destroy(SkalaAhp $skala)
    {
        $skala->delete();
        return redirect()->route('skala.index')->with('success', 'Skala berhasil dihapus.');
    }
}
