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
        Schema::create('arsips', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('kode_arsip', 100)->unique();
            $table->enum('kategori', ['arsip_aktif', 'arsip_inAktif', 'lainnya'])->default('arsip_aktif');
            $table->string('kode_klasifikasi');
            $table->date('tanggal_arsip');
            $table->string('nama_file');
            $table->text('uraian');
            $table->string('path_file');
            $table->enum('status_legalisasi', ['onProgress', 'legal'])->default('onProgress');
            $table->foreignUuid('user_id')->constrained('users', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsips');
    }
};
