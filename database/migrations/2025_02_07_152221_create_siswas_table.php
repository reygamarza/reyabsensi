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
        Schema::create('siswas', function (Blueprint $table) {
            $table->string('nis', 17)->primary();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->foreign('id_user')->references('id')->on('users');
            $table->string('nik_ayah', 16)->nullable();
            $table->foreign('nik_ayah')->references('nik')->on('wali_siswas')->onDelete('set null');
            $table->string('nik_ibu', 16)->nullable();
            $table->foreign('nik_ibu')->references('nik')->on('wali_siswas')->onDelete('set null');
            $table->string('nik_wali', 16)->nullable();
            $table->foreign('nik_wali')->references('nik')->on('wali_siswas')->onDelete('set null');
            $table->unsignedInteger('id_kelas');
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('cascade');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('nisn', 10)->unique();
            $table->string('tempat_lahir', 25);
            $table->date('tanggal_lahir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
