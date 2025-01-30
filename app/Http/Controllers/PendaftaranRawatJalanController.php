<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\PendaftaranRawatJalan;
use Carbon\Carbon;

class PendaftaranRawatJalanController extends Controller
{
    public function create()
    {
        $pasien = Pasien::all();
        return view('pendaftaran.create', compact('pasien'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pasien_id' => 'required|exists:pasien,id',
            'poli_tujuan' => 'required',
            'dokter_tujuan' => 'required',
        ]);

        $tanggalHariIni = Carbon::today();
        $jumlahAntrian = PendaftaranRawatJalan::whereDate('tanggal_daftar', $tanggalHariIni)->count();
        $nomorAntrian = 'ANTR-' . str_pad($jumlahAntrian + 1, 3, '0', STR_PAD_LEFT);

        PendaftaranRawatJalan::create([
            'pasien_id' => $request->pasien_id,
            'nomor_antrian' => $nomorAntrian,
            'tanggal_daftar' => $tanggalHariIni,
            'poli_tujuan' => $request->poli_tujuan,
            'dokter_tujuan' => $request->dokter_tujuan,
        ]);

        return redirect()->route('pendaftaran.create')->with('success', 'Pendaftaran berhasil, Nomor Antrian: ' . $nomorAntrian);
    }

    
}
