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
        Schema::create('waktu__absens', function (Blueprint $table) {
            $table->increments('id_waktu_absen');
            $table->time('jam_masuk');
            $table->time('batas_jam_masuk');
            $table->time('jam_pulang');
            $table->time('batas_jam_pulang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waktu__absens');
    }
};
