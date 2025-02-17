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
        Schema::create('lokasi_sekolahs', function (Blueprint $table) {
            $table->increments('id_lokasi_sekolah');
            $table->string('latitude');
            $table->string('longitude');
            $table->float('radius_maksimum')->default(200.0)->comment('meters');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lokasi_sekolahs');
    }
};
