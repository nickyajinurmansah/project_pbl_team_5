<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengguna', function (Blueprint $table) {
            $table->integer('id_pengguna')->autoIncrement()->primary(); // Sesuai manual: INT
            $table->string('nama', 45);
            $table->string('no_hp', 15)->nullable();
            $table->string('alamat', 45)->nullable();
            $table->integer('Akun_id_Akun')->nullable(); // FK ke Akun
            
            // Timestamps yang benar:
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            
            // Foreign Key constraint (opsional, bisa lewat migration atau manual):
            // $table->foreign('Akun_id_Akun')->references('id_Akun')->on('Akun');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengguna');
    }
};