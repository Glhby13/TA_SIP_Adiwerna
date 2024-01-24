<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('informasitempatprakerin', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perusahaan');
            $table->text('deskripsi')->nullable();
            $table->string('posisi')->nullable();;
            $table->enum('jurusan',['DPIB', 'TE', 'TJKT', 'TK', 'TM', 'TO', 'TPFL'])->nullable();
            $table->string('persyaratan')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('telp')->nullable();
            $table->string('alamat')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        DB::statement("ALTER TABLE informasitempatprakerin ADD image LONGBLOB NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informasitempatprakerin');
    }
};
