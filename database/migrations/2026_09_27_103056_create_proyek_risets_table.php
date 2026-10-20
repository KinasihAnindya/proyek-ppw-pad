<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyekRisetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void {
    Schema::create('proyek_riset', function (Blueprint $table) {
        $table->id('proyek_id');
        $table->string('judul_penelitian_simulasi');
        $table->text('deskripsi_singkat')->nullable();
        $table->string('dokumentasi_visual_utama')->nullable();
        $table->date('tanggal_mulai');
        $table->date('tanggal_selesai')->nullable();
        $table->string('status_proyek');
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
        Schema::dropIfExists('proyek_risets');
    }
}
