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
        //
        Schema::create('pengurus', function (Blueprint $table){
            $table->id();
            $table->string('nama', 50);
            $table->string('jabatan', 30);
            $table->string('no_hp', 20)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('foto')->default('pengurus/default.jpg');
            $table->string('bio', 100)->nullable();
            $table->enum ('status', ['Aktif', 'Non-Aktif'])->default('Aktif');
            $table->timestamps('created_at')->useCurrent();
            $table->timestamps('updated_at')->nullable()->useCurrentOnUpdate();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
