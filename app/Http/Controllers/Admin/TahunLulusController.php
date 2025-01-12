<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TahunLulus;
use Illuminate\Http\Request;

class TahunLulusController extends Controller
{
    public function index()
    {
        $tahunLulus = TahunLulus::all();
        return view('admin.tahun-lulus.index', compact('tahunLulus'));
    }

    public function create()
    {
        return view('admin.tahun-lulus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun_lulus' => 'required|max:10',
            'keterangan' => 'required|max:50'
        ]);

        TahunLulus::create($request->all());
        return redirect()->route('admin.tahun-lulus.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(TahunLulus $tahunLulus)
    {
        return view('admin.tahun-lulus.edit', compact('tahunLulus'));
    }

    public function update(Request $request, TahunLulus $tahunLulus)
    {
        $request->validate([
            'tahun_lulus' => 'required|max:10',
            'keterangan' => 'required|max:50'
        ]);

        $tahunLulus->update($request->all());
        return redirect()->route('admin.tahun-lulus.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy(TahunLulus $tahunLulus)
    {
        $tahunLulus->delete();
        return redirect()->route('admin.tahun-lulus.index')->with('success', 'Data berhasil dihapus');
    }
}