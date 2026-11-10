<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobVacanciesTable extends Migration
{
    public function up() {
    Schema::create('job_vacancies', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description');
        $table->string('location');
        $table->string('company');
        $table->string('type')->default('Full-time');
        $table->string('logo')->nullable();
        $table->integer('salary')->nullable();
        $table->timestamps();
        });
    }

    public function down() {
    Schema::dropIfExists('job_vacancies');
    }
}
