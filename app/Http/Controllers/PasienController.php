<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pasien;

class PasienController extends Controller
{
    public function index()
    {
        $pasien = Pasien::all();
        return view('pasien.index', compact('pasien'));
    }
    

    public function create()
    {
        return view('pasien.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
        ]);

        Pasien::create([
            'no_medical_record' => 'MR-' . time(),
            'no_ktp' => $request->no_ktp,
            'nama' => $request->nama,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat
        ]);

        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil ditambahkan');
    }

    public function show($id)
    {
        $pasien = Pasien::findOrFail($id);
        return view('pasien.show', compact('pasien'));
    }

    public function edit($id)
    {
        $pasien = Pasien::findOrFail($id);
        return view('pasien.edit', compact('pasien'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
        ]);

        $pasien = Pasien::findOrFail($id);
        $pasien->update([
            'no_ktp' => $request->no_ktp,
            'nama' => $request->nama,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat
        ]);

        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil diperbarui');
    }

    public function search(Request $request)
    {
        $query = $request->input('search');
        
        if (!$query) {
            return response()->json([]); // Jika tidak ada query, kembalikan array kosong
        }

        // Menyaring pasien berdasarkan nama, no_ktp, atau no_medical_record
        $pasien = Pasien::where('nama', 'LIKE', "%$query%")
                        ->orWhere('no_ktp', 'LIKE', "%$query%")
                        ->orWhere('no_medical_record', 'LIKE', "%$query%")
                        ->get();

        // Mengembalikan hasil pencarian dalam bentuk JSON
        return response()->json($pasien);
    }

    public function destroy($id)
    {
        $pasien = Pasien::findOrFail($id);
        $pasien->delete();

        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil dihapus');
    }
}
