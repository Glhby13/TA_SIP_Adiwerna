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
        Schema::create('bimbingans', function (Blueprint $table) {
            $table->id();
            $table->string('NIP');//guru
            $table->string('NIS')->unique(); //siswa
            $table->string('laporan')->nullable();//siswa
            $table->integer('nilai')->nullable();
            $table->enum('status',['Belum Mengumpulkan', 'Sudah Mengumpulkan', 'Revisi', 'Sudah Revisi', 'ACC'])->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bimbingans');
    }
};
