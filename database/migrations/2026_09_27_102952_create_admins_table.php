<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void {
    Schema::create('admin', function (Blueprint $table) {
        $table->id('admin_id');
        $table->string('email')->unique();
        $table->string('password');
        $table->string('nama_lengkap');
        $table->string('peran');
        $table->boolean('status_akses')->default(true);
        $table->dateTime('last_login')->nullable();
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
        Schema::dropIfExists('admins');
    }
}
