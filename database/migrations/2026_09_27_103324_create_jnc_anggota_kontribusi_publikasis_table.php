<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJncAnggotaKontribusiPublikasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jnc_anggota_kontribusi_publikasi', function (Blueprint $table) {
        $table->id('jnc_kontribusi_id');
        $table->foreignId('anggota_alumni_id')->constrained('anggota_alumni', 'anggota_alumni_id')->onDelete('cascade');
        $table->foreignId('publikasi_id')->constrained('publikasi_hibah', 'publikasi_id')->onDelete('cascade');
        $table->string('peran_penulis')->nullable();
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
        Schema::dropIfExists('jnc_anggota_kontribusi_publikasis');
    }
}
