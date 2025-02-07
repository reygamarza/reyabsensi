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
        Schema::create('waktu_absensis', function (Blueprint $table) {
            $table->increments('id_waktu_absensi');
            $table->time('absen_masuk');
            $table->time('batas_absen_masuk');
            $table->time('absen_pulang');
            $table->time('batas_absen_pulang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waktu_presensis');
    }
};
