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
        Schema::create('data_anak', function (Blueprint $table) {
            $table->integer('idanak_panti')->autoIncrement()->primary();
            $table->string('nik', 16)->unique(); // Tambahkan unique agar tidak duplikat
            $table->string('nama_lengkap');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->date('tanggal_masuk');
            $table->string('kategori_anak');
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->default('Aktif');
            $table->text('alamat');
            $table->string('foto_anak')->nullable();

            // --- TAMBAHAN BARU ---
            $table->string('nama_ayah')->nullable(); // Ganti nama ortu jadi ayah
            $table->string('nama_ibu')->nullable();  // Dan ibu
            $table->text('alamat_orang_tua')->nullable(); // Alamat ortu
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_anak');
    }
};