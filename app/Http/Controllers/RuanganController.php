<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function index()
    {
        $ruangans = Ruangan::all();
        return view('admin.ruangan.index', compact('ruangans'));
    }

    public function create()
    {
        return view('admin.ruangan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_ruang' => 'required|string|max:100',
            'kapasitas' => 'required|integer|min:1',
            'lokasi' => 'required|string|max:200',
            'tipe' => 'nullable|string|max:50',
            'keterangan' => 'nullable|string',
        ]);

        Ruangan::create($validated);

        return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil ditambahkan');
    }

    public function edit($id_ruangan)
    {
        $ruangan = Ruangan::findOrFail($id_ruangan);
        return view('admin.ruangan.edit', compact('ruangan'));
    }

    public function update(Request $request, $id_ruangan)
    {
        $ruangan = Ruangan::findOrFail($id_ruangan);

        $validated = $request->validate([
            'nama_ruang' => 'required|string|max:100',
            'kapasitas' => 'required|integer|min:1',
            'lokasi' => 'required|string|max:200',
            'tipe' => 'nullable|string|max:50',
            'keterangan' => 'nullable|string',
        ]);

        $ruangan->update($validated);

        return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil diupdate');
    }

    public function destroy($id_ruangan)
    {
        $ruangan = Ruangan::findOrFail($id_ruangan);
        $ruangan->delete();

        return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil dihapus');
    }
}
