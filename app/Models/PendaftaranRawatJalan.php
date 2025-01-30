<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PendaftaranRawatJalan extends Model
{
    use HasFactory;

    protected $table = 'simrs.pendaftaran_rawat_jalan';

    protected $fillable = ['pasien_id', 'nomor_antrian', 'tanggal_daftar', 'poli_tujuan', 'dokter_tujuan'];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }
}
