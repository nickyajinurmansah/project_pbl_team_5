<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('data_anak', function (Blueprint $table) {
            // Cek dulu apakah kolom ada sebelum dihapus
            if (Schema::hasColumn('data_anak', 'nama_Ortu')) {
                $table->dropColumn('nama_Ortu');
            }
        });
    }

    public function down(): void
    {
        Schema::table('data_anak', function (Blueprint $table) {
            $table->string('nama_Ortu', 45)->nullable();
        });
    }
};