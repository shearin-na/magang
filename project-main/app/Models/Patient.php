<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak mengikuti konvensi
    protected $table = 'patients';

    // Tentukan kolom yang dapat diisi massal
    protected $fillable = [
        'no_rm',
        'biaya_pendaftaran_administrasi',
        'biaya_akomodasi_rawat_inap',
        'biaya_pemeriksaan_konsultasi',
        'biaya_tindakan_medical',
        'biaya_ibu_bayi_balita',
        'biaya_obat_bahan_medis',
        'total_estimasi'
    ];

    protected $casts = [
        'biaya_pendaftaran_administrasi' => 'decimal:2',
        'biaya_akomodasi_rawat_inap' => 'decimal:2',
        'biaya_pemeriksaan_konsultasi' => 'decimal:2',
        'biaya_tindakan_medical' => 'decimal:2',
        'biaya_ibu_bayi_balita' => 'decimal:2',
        'biaya_obat_bahan_medis' => 'decimal:2',
        'total_estimasi' => 'decimal:2'
    ];

    public function claim()
    {
        return $this->belongsTo(Claim::class, 'no_rm', 'no_rm');
    }
}
