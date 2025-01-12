<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KonsentrasiKeahlian;
use App\Models\ProgramKeahlian;
use Illuminate\Http\Request;

class KonsentrasiKeahlianController extends Controller
{
    public function index()
    {
        $konsentrasiKeahlian = KonsentrasiKeahlian::with('programKeahlian.bidangKeahlian')->get();
        return view('admin.konsentrasi-keahlian.index', compact('konsentrasiKeahlian'));
    }

    public function create()
    {
        $programKeahlian = ProgramKeahlian::with('bidangKeahlian')->get();
        return view('admin.konsentrasi-keahlian.create', compact('programKeahlian'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_program_keahlian' => 'required|exists:tbl_program_keahlian,id_program_keahlian',
            'kode_konsentrasi_keahlian' => 'required|unique:tbl_konsentrasi_keahlian,kode_konsentrasi_keahlian|max:10',
            'konsentrasi_keahlian' => 'required|max:100'
        ]);

        KonsentrasiKeahlian::create($request->all());
        return redirect()->route('admin.konsentrasi-keahlian.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(KonsentrasiKeahlian $konsentrasiKeahlian)
    {
        $programKeahlian = ProgramKeahlian::with('bidangKeahlian')->get();
        return view('admin.konsentrasi-keahlian.edit', compact('konsentrasiKeahlian', 'programKeahlian'));
    }

    public function update(Request $request, KonsentrasiKeahlian $konsentrasiKeahlian)
    {
        $request->validate([
            'id_program_keahlian' => 'required|exists:tbl_program_keahlian,id_program_keahlian',
            'kode_konsentrasi_keahlian' => 'required|unique:tbl_konsentrasi_keahlian,kode_konsentrasi_keahlian,'.$konsentrasiKeahlian->id_konsentrasi_keahlian.',id_konsentrasi_keahlian|max:10',
            'konsentrasi_keahlian' => 'required|max:100'
        ]);

        $konsentrasiKeahlian->update($request->all());
        return redirect()->route('admin.konsentrasi-keahlian.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy(KonsentrasiKeahlian $konsentrasiKeahlian)
    {
        $konsentrasiKeahlian->delete();
        return redirect()->route('admin.konsentrasi-keahlian.index')->with('success', 'Data berhasil dihapus');
    }
}