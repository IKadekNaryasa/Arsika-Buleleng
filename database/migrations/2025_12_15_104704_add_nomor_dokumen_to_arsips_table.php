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
        Schema::table('arsips', function (Blueprint $table) {
            $table->string('nomor_dokumen')->after('uraian')->default('-');
            $table->integer('masa_aktif')->after('nomor_dokumen')->default(2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('arsips', function (Blueprint $table) {
            $table->dropColumn('nomor_dokumen');
            $table->dropColumn('masa_aktif');
        });
    }
};
