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
        // 1. Tabel Akun
        Schema::create('akun', function (Blueprint $table) {
            $table->id('id_Akun'); // Ini sudah otomatis Primary Key
            $table->string('username')->unique();
            $table->string('password');
            $table->enum('role', ['Admin', 'Yayasan', 'Pengasuh', 'Anak Panti Eksternal']);
            $table->rememberToken();
            $table->timestamps();
        });

        // 2. Tabel Password Reset
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // 3. Tabel Sessions
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            // user_id harus merujuk ke id_Akun di tabel akun
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // PERBAIKAN: Nama tabel harus 'akun' agar bisa di-refresh tanpa error exist
        Schema::dropIfExists('akun'); 
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};