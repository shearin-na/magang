<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id(); // Kolom ID untuk primary key
            $table->unsignedBigInteger('no_rm')->unique(); // Kolom untuk nomor rekam medis dengan UNIQUE constraint dan tipe data UNSIGNED BIGINT
            $table->decimal('biaya_pendaftaran_administrasi', 12, 2); // Biaya Pendaftaran & Administrasi
            $table->decimal('biaya_akomodasi_rawat_inap', 12, 2); // Biaya Akomodasi Rawat Inap
            $table->decimal('biaya_pemeriksaan_konsultasi', 12, 2); // Biaya Pemeriksaan & Konsultasi
            $table->decimal('biaya_tindakan_medical', 12, 2); // Biaya Tindakan Medis Spesialistik & Non Spesialistik
            $table->decimal('biaya_ibu_bayi_balita', 12, 2); // Biaya Ibu, Bayi, dan Balita
            $table->decimal('biaya_obat_bahan_medis', 12, 2); // Biaya Obat & Bahan Medis
            $table->timestamps(); // Kolom untuk created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients'); // Menghapus tabel jika rollback
    }
};
