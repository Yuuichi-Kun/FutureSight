<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramKeahlian;
use App\Models\BidangKeahlian;
use Illuminate\Http\Request;

class ProgramKeahlianController extends Controller
{
    public function index()
    {
        $programKeahlian = ProgramKeahlian::with('bidangKeahlian')->get();
        return view('admin.program-keahlian.index', compact('programKeahlian'));
    }

    public function create()
    {
        $bidangKeahlian = BidangKeahlian::all();
        return view('admin.program-keahlian.create', compact('bidangKeahlian'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_bidang_keahlian' => 'required|exists:tbl_bidang_keahlian,id_bidang_keahlian',
            'kode_program_keahlian' => 'required|unique:tbl_program_keahlian,kode_program_keahlian|max:10',
            'program_keahlian' => 'required|max:100'
        ]);

        ProgramKeahlian::create($request->all());
        return redirect()->route('admin.program-keahlian.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(ProgramKeahlian $programKeahlian)
    {
        $bidangKeahlian = BidangKeahlian::all();
        return view('admin.program-keahlian.edit', compact('programKeahlian', 'bidangKeahlian'));
    }

    public function update(Request $request, ProgramKeahlian $programKeahlian)
    {
        $request->validate([
            'id_bidang_keahlian' => 'required|exists:tbl_bidang_keahlian,id_bidang_keahlian',
            'kode_program_keahlian' => 'required|unique:tbl_program_keahlian,kode_program_keahlian,'.$programKeahlian->id_program_keahlian.',id_program_keahlian|max:10',
            'program_keahlian' => 'required|max:100'
        ]);

        $programKeahlian->update($request->all());
        return redirect()->route('admin.program-keahlian.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy(ProgramKeahlian $programKeahlian)
    {
        $programKeahlian->delete();
        return redirect()->route('admin.program-keahlian.index')->with('success', 'Data berhasil dihapus');
    }
}