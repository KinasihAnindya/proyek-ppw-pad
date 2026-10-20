<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotaAlumnisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void {
    Schema::create('anggota_alumni', function (Blueprint $table) {
        $table->id('anggota_alumni_id');
        $table->string('nama_lengkap');
        $table->string('kepakaran')->nullable();
        $table->string('peran_lab')->nullable();
        $table->integer('tahun_masuk');
        $table->integer('tahun_lulus_keluar')->nullable();
        $table->string('kontak_profesional')->nullable();
        $table->string('tautan_repositori_pribadi')->nullable();
        $table->foreignId('admin_id')->constrained('admin', 'admin_id')->onDelete('cascade');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anggota_alumnis');
    }
}
