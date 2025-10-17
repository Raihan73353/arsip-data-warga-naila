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
        Schema::create('akte_nikahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('suami_ktp_id')->constrained('ktps')->onDelete('cascade');
            $table->foreignId('istri_ktp_id')->constrained('ktps')->onDelete('cascade');
            $table->string('no_akte')->unique();
            $table->date('tanggal_nikah');
            $table->string('tempat_nikah')->nullable();
            $table->string('nama_penghulu')->nullable();
            $table->string('file_scan')->nullable(); // File hasil scan Akte Nikah
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akte_nikahs');
    }
};
