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
        Schema::create('claims', function (Blueprint $table) {
            $table->bigIncrements('id'); // This line is attempting to add the 'id' column
            $table->unsignedBigInteger('no_rm');
            $table->string('nama_lengkap');
            $table->string('no_bpjs');
            $table->string('no_sep');
            $table->string('kelas_pasien');
            $table->date('tanggal');
            $table->text('alamat');
            $table->decimal('klaim', 12, 2)->default(0);
            $table->string('diagnosa');
            $table->timestamps();
        });
        
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('claims', function (Blueprint $table) {
            $table->decimal('klaim', 12, 2)->default(NULL)->change();  // Revert default value if rolling back
        });
    }
    };