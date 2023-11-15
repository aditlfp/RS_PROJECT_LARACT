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
            $table->id();
            $table->increments('no_reg');
            $table->string('nama_pasien');
            $table->string('NIK');
            $table->text('alamat_lengkap')->nullable();
            $table->integer('umur')->nullable();
            $table->string('no_hp', 100)->nullable();
            $table->text('keluhan')->nullable();
            $table->string('tgl_daftar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
