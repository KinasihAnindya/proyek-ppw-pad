<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaIsuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Auth;

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

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::resource('users', UserController::class);
    Route::resource('jobs', JobController::class);
});