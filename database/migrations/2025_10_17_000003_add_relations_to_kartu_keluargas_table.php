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
    Schema::table('kartu_keluargas', function (Blueprint $table) {
        $table->foreignId('kepala_keluarga_id')->nullable()->constrained('ktps')->onDelete('set null');
        $table->foreignId('isteri_id')->nullable()->constrained('ktps')->onDelete('set null');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kartu_keluargas');
    }
};
