<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublikasiHibahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publikasi_hibah', function (Blueprint $table) {
        $table->id('publikasi_id');
        $table->string('judul_publikasi_hibah');
        $table->string('jenis_luaran');
        $table->string('nama_jurnal_penerbit')->nullable();
        $table->integer('tahun_terbit_hibah');
        $table->string('tautan_doi_dokumen')->nullable();
        $table->foreignId('proyek_id')->nullable()->constrained('proyek_riset', 'proyek_id')->onDelete('set null');
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
        Schema::dropIfExists('publikasi_hibahs');
    }
}
