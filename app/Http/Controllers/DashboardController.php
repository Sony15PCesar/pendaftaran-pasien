<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranRawatJalan;
use App\Models\Pasien;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pasienRawatJalan = PendaftaranRawatJalan::join('pasien', 'pendaftaran_rawat_jalan.pasien_id', '=', 'pasien.id')
            ->select(
                'pendaftaran_rawat_jalan.nomor_antrian',
                'pasien.no_medical_record',
                'pasien.nama AS nama_pasien',
                'pasien.jenis_kelamin',
                'pasien.tanggal_lahir',
                'pasien.alamat',
                'pendaftaran_rawat_jalan.tanggal_daftar',
                'pendaftaran_rawat_jalan.poli_tujuan',
                'pendaftaran_rawat_jalan.dokter_tujuan'
            )
            ->orderBy('pendaftaran_rawat_jalan.tanggal_daftar', 'DESC')
            ->paginate(10);

        return view('dashboard', compact('pasienRawatJalan'));
    }
}