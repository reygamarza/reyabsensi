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
        Schema::create('koordinat__sekolahs', function (Blueprint $table) {
            $table->increments('id_koordinat_sekolah');
            $table->string('titik_koordinat');
            $table->integer('radius');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('koordinat__sekolahs');
    }
};
