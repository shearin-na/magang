<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    protected $fillable = [
        'no_rm',
        'nama_lengkap',
        'no_bpjs',
        'no_sep',
        'kelas_pasien',
        'tanggal',
        'alamat',
        'diagnosa',
        'total_klaim'
    ];

    protected $casts = [
        'total_klaim' => 'decimal:2'
    ];
}
