<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeritaIsusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('berita_isu', function (Blueprint $table) {
            $table->id('berita_id');
            $table->string('judul_berita');
            $table->text('ringkasan_isi');
            $table->longText('konten_lengkap')->nullable();
            $table->string('kategori_isu'); // Contoh: Isu Strategis, Event, Riset
            $table->string('gambar_header')->nullable();
            $table->date('tanggal_publikasi');
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
        Schema::dropIfExists('berita_isus');
    }
}
