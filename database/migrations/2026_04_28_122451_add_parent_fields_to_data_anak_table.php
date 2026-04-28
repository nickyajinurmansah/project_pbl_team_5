<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('data_anak', function (Blueprint $table) {
            // Tambah kolom baru untuk orang tua
            if (!Schema::hasColumn('data_anak', 'nama_ayah')) {
                $table->string('nama_ayah', 45)->nullable()->after('nama_Ortu');
            }
            
            if (!Schema::hasColumn('data_anak', 'nama_ibu')) {
                $table->string('nama_ibu', 45)->nullable()->after('nama_ayah');
            }
            
            if (!Schema::hasColumn('data_anak', 'alamat_orang_tua')) {
                $table->text('alamat_orang_tua')->nullable()->after('nama_ibu');
            }
        });
    }

    public function down(): void
    {
        Schema::table('data_anak', function (Blueprint $table) {
            $table->dropColumn(['nama_ayah', 'nama_ibu', 'alamat_orang_tua']);
        });
    }
};