<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RawStudent;
use Illuminate\Http\Request;

class RawStudentController extends Controller
{
    public function index()
    {
        $rawStudents = RawStudent::latest()->paginate(10);
        return view('admin.raw-students.index', compact('rawStudents'));
    }

    public function create()
    {
        return view('admin.raw-students.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nisn' => 'nullable|string|max:20',
            'nik' => 'nullable|string|max:20',
            'nama_depan' => 'required|string|max:50',
            'nama_belakang' => 'required|string|max:50',
            'tempat_lahir' => 'nullable|string|max:50',
            'tgl_lahir' => 'nullable|date',
            'alamat' => 'nullable|string|max:255',
        ]);

        RawStudent::create($validated);

        return redirect()
            ->route('admin.raw-students.index')
            ->with('success', 'Data siswa berhasil ditambahkan');
    }

    public function edit(RawStudent $rawStudent)
    {
        return view('admin.raw-students.edit', compact('rawStudent'));
    }

    public function update(Request $request, RawStudent $rawStudent)
    {
        $validated = $request->validate([
            'nisn' => 'nullable|string|max:20',
            'nik' => 'nullable|string|max:20',
            'nama_depan' => 'required|string|max:50',
            'nama_belakang' => 'required|string|max:50',
            'tempat_lahir' => 'nullable|string|max:50',
            'tgl_lahir' => 'nullable|date',
            'alamat' => 'nullable|string|max:255',
        ]);

        $rawStudent->update($validated);

        return redirect()
            ->route('admin.raw-students.index')
            ->with('success', 'Data siswa berhasil diperbarui');
    }

    public function destroy(RawStudent $rawStudent)
    {
        $rawStudent->delete();

        return redirect()
            ->route('admin.raw-students.index')
            ->with('success', 'Data siswa berhasil dihapus');
    }
} 