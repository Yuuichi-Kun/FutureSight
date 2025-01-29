<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\School;
use Illuminate\Support\Facades\Validator;

class SchoolController extends Controller
{
    public function index()
    {
        $school = School::first();
        return view('admin.school.index', compact('school'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'npsn' => 'required|string|max:20|unique:tbl_sekolah,npsn',
            'nss' => 'required|string|max:20|unique:tbl_sekolah,nss',
            'nama_sekolah' => 'required|string|max:50',
            'alamat' => 'required|string|max:50',
            'no_telp' => 'required|string|max:15',
            'website' => 'required|string|max:50',
            'email' => 'required|email|max:50|unique:tbl_sekolah,email',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        School::create($request->all());
        return redirect()->route('admin.school.index')->with('success', 'Profile sekolah berhasil disimpan');
    }

    public function update(Request $request, School $school)
    {
        $validator = Validator::make($request->all(), [
            'npsn' => 'required|string|max:20|unique:tbl_sekolah,npsn,'.$school->id_sekolah.',id_sekolah',
            'nss' => 'required|string|max:20|unique:tbl_sekolah,nss,'.$school->id_sekolah.',id_sekolah',
            'nama_sekolah' => 'required|string|max:50',
            'alamat' => 'required|string|max:50',
            'no_telp' => 'required|string|max:15',
            'website' => 'required|string|max:50',
            'email' => 'required|email|max:50|unique:tbl_sekolah,email,'.$school->id_sekolah.',id_sekolah',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $school->update($request->all());
        return redirect()->route('admin.school.index')->with('success', 'Profile sekolah berhasil diperbarui');
    }
}