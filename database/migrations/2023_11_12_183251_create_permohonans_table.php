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
        Schema::create('permohonans', function (Blueprint $table) {
            $table->id();
            $table->string('NIS')->unique()->nullable()->length(20); //siswa
            $table->string('tempat_prakerin')->nullable(); //siswa
            $table->string('alamat_tempat_prakerin')->nullable(); //siswa
            $table->string('email_tempat_prakerin')->nullable(); //siswa
            $table->string('telp_tempat_prakerin')->nullable(); //siswa
            $table->float('durasi')->nullable(); //siswa
            $table->string('balasan')->nullable();
            $table->enum('status', ['Mengajukan', 'Diterima', 'Ditolak'])->nullable();
            $table->date('tanggal_mulai')->nullable(); //siswa
            $table->date('tanggal_selesai')->nullable(); //siswa
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonans');
    }
};
