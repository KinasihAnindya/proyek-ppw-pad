<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaIsuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GoogleController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/detail-lowongan/{title}', [JobController::class, 'galeriLowongan']) -> name('galeri.lowongan');

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
    Route::resource('gallery', GalleryController::class);
});

Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

Route::post('/notifikasi/baca-semua', function (\Illuminate\Http\Request $request) {
    $request->user()->unreadNotifications->markAsRead();
    return back()->with('success', 'Semua notifikasi ditandai sudah dibaca.');
})->middleware('auth')->name('notifikasi.baca');