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
        Schema::create('pengurus', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 45);
            $table->enum('jenisKelamin', ['Pria', 'Perempuan']);
            $table->string('jabatan', 45);
            $table->string('no_hp',20);
            $table->string('email',50);
            $table->string('foto', 255)->default('default-Pengurus.jpg');
            $table->string('bio', 100);
            $table->enum('status', ['Aktif', 'non-Aktif'])->default('non-Aktif');
            $table->string('alamat', 50);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengurus');
    }
};
