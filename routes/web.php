<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaIsuController;

Route::resource('berita', BeritaIsuController::class);