<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaIsuController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes([
    'register' => false,
    'reset'    => false,
]);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    Route::resource('berita', BeritaIsuController::class)->parameters([
        'berita' => 'berita'
    ]);
});