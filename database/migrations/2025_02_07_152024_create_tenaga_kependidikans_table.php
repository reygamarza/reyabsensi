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
        Schema::create('tenaga_kependidikans', function (Blueprint $table) {
            $table->string('nip', 18)->primary();
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('nuptk', 16)->nullable()->unique();
            $table->string('no_telp', 16)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenaga_kependidikans');
    }
};
