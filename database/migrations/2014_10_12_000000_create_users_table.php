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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('NIP')->unique()->nullable()->length(20); //guru
            $table->string('NIS')->unique()->nullable()->length(20); //siswa
            $table->string('no_admin')->unique()->nullable()->length(20);//admin
            $table->string('name')->length(50);
            $table->string('email')->unique()->nullable();
            $table->string('password')->default(bcrypt('password'));
            $table->enum('role', ['admin', 'guru', 'siswa'])->default('siswa');
            $table->enum('jurusan',['DPIB', 'TE', 'TJKT', 'TK', 'TM', 'TKRO', 'TPFL'])->nullable();
            $table->string('kelas')->nullable();//siswa
            $table->string('telp')->nullable();
            $table->integer('kuota_bimbingan')->nullable();
            $table->integer('nilai')->nullable();
            $table->enum('status',['Belum Mendaftar', 'Sudah Mendaftar', 'Sedang Prakerin', 'Selesai Prakerin'])
                  ->default(null)
                  ->nullable();
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });

        DB::statement("ALTER TABLE users ADD image LONGBLOB NULL");
        
        // Set default status based on role
        DB::table('users')->update(['status' => null]);
        DB::table('users')->where('role', 'siswa')->update(['status' => 'Belum Mendaftar']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
