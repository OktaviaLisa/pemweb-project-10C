<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\UserController;

Route::get('/login', [UserController::class, 'showLogin'])->name('login');
Route::post('/login', [UserController::class, 'loginProcess'])->name('login.proses');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/register', [UserController::class, 'showRegister'])->name('register');
Route::post('/register', [UserController::class, 'registerProcess'])->name('register.proses');


Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/kelas', [KelasController::class, 'index']);


use App\Http\Controllers\KelasKeranjangController;
// di routes/web.php
Route::middleware(['web'])->group(function () {
    Route::get('/kelaskeranjang', [KelasKeranjangController::class, 'index'])->middleware('auth')->name('kelaskeranjang');
});

Route::get('/daftar', [KelasKeranjangController::class, 'showDaftar'])->middleware('auth')->name('daftar');
Route::post('/simpan-session-prosesbayar', [KelasKeranjangController::class, 'simpanSession'])->name('simpan.session.dan.ke.prosesbayar');
Route::get('/prosesbayar', [KelasKeranjangController::class, 'showProsesBayar'])->name('prosesbayar');

Route::post('/bayar', [KelasKeranjangController::class, 'bayar'])->name('bayar');

use App\Http\Controllers\PembayaranController;

Route::post('/konfirmasibayar', [PembayaranController::class, 'tampilKonfirmasi'])->name('konfirmasibayar');
Route::get('/konfirmasibayar', [PembayaranController::class, 'tampilKonfirmasi'])->name('konfirmasibayar');

Route::get('/kelasterdaftar', [KelasKeranjangController::class, 'terdaftar'])->name('kelasterdaftar');

