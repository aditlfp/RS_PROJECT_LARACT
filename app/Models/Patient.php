<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_reg',
        'nama_pasien',
        'NIK',
        'alamat_lengkap',
        'no_tlp',
        'umur',
        'keluhan',
        'tgl_daftar'
    ];
}
