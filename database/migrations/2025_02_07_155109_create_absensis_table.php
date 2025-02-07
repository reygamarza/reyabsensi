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
        Schema::create('absensis', function (Blueprint $table) {
            $table->increments('id_absensi');
            $table->string('nis', 17);
            $table->foreign('nis')->references('nis')->on('siswas')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('status', ['Hadir', 'Sakit', 'Izin', 'Alfa'])->default('Alfa');
            $table->string('foto_masuk')->nullable();
            $table->string('foto_pulang')->nullable();
            $table->text('keterangan')->nullable();
            $table->date('tanggal')->nullable();
            $table->time('jam_masuk')->nullable();
            $table->time('jam_pulang')->nullable();
            $table->string('latitude_masuk')->nullable();
            $table->string('longitude_masuk')->nullable();
            $table->string('latitude_pulang')->nullable();
            $table->string('longitude_pulang')->nullable();
            $table->integer('menit_keterlambatan_masuk')->nullable();
            $table->integer('menit_keterlambatan_pulang')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
