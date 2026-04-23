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
        
    Schema::create('data_anak', function (Blueprint $table){
        $table->integer('idanak_panti')->autoIncrement()->primary(); // ✅ FIXED
        $table->char('NIK', 16)->unique();
        $table->string('nama', 45);
        $table->date('tgl_lahir'); 
        $table->enum('jns_kelamin', ['L', 'P']); 
        $table->string('alamat', 45)->nullable(); 
        $table->date('tgl_masuk'); 
        $table->enum('status', ['Aktif', 'Alumni', 'Pindah'])->default('Aktif'); 
        $table->string('nama_Ortu', 45)->nullable(); 
        $table->string('Foto', 50)->nullable(); 
        $table->enum('kategori_anak', ['Internal', 'External']);
        $table->timestamp('created_at')->useCurrent();
        $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Fixed: dropIfExists (ada 's')
        Schema::dropIfExists('data_anak');
    }
};