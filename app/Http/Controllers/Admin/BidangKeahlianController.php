<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BidangKeahlian;
use Illuminate\Http\Request;

class BidangKeahlianController extends Controller
{
    public function index()
    {
        $bidangKeahlian = BidangKeahlian::all();
        return view('admin.bidang-keahlian.index', compact('bidangKeahlian'));
    }

    public function create()
    {
        return view('admin.bidang-keahlian.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_bidang_keahlian' => 'required|unique:tbl_bidang_keahlian,kode_bidang_keahlian|max:10',
            'bidang_keahlian' => 'required|max:100'
        ]);

        BidangKeahlian::create($request->all());
        return redirect()->route('admin.bidang-keahlian.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(BidangKeahlian $bidangKeahlian)
    {
        return view('admin.bidang-keahlian.edit', compact('bidangKeahlian'));
    }

    public function update(Request $request, BidangKeahlian $bidangKeahlian)
    {
        $request->validate([
            'kode_bidang_keahlian' => 'required|unique:tbl_bidang_keahlian,kode_bidang_keahlian,'.$bidangKeahlian->id_bidang_keahlian.',id_bidang_keahlian|max:10',
            'bidang_keahlian' => 'required|max:100'
        ]);

        $bidangKeahlian->update($request->all());
        return redirect()->route('admin.bidang-keahlian.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy(BidangKeahlian $bidangKeahlian)
    {
        $bidangKeahlian->delete();
        return redirect()->route('admin.bidang-keahlian.index')->with('success', 'Data berhasil dihapus');
    }
}