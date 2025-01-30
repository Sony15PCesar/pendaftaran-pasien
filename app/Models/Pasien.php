<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'simrs.pasien';

    protected $fillable = ['no_medical_record', 'no_ktp', 'nama', 'tanggal_lahir', 'jenis_kelamin', 'alamat'];

}
