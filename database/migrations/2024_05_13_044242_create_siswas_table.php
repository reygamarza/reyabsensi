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
            $table->string('nis')->primary();

            $table->unsignedBigInteger('id_user')->nullable();
            $table->foreign('id_user')->references('id')->on('users');

            $table->unsignedInteger('id_kelas')->nullable();
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onUpdate('cascade')->onDelete('set null');

            $table->enum('jenis_kelamin', ['laki laki', 'perempuan']);
            $table->string('nisn')->unique();
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
