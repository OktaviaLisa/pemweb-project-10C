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

Route::get('/admin', function () {return view('admin');})->name('admin');

use App\Http\Controllers\AdminController;

Route::get('/admin', [AdminController::class, 'index'])->name('admin');

use App\Http\Controllers\BootcampController;

Route::get('/bootcamp', [BootcampController::class, 'index'])->name('bootcamp.index');
Route::post('/expirebatch', [BootcampController::class, 'expireBatch'])->name('bootcamp.expire');

Route::get('/bootcamp/create', [BootcampController::class, 'create'])->name('bootcamp.create');
Route::get('/tambahkelas', [BootcampController::class, 'create'])->name('bootcamp.create');
Route::post('/tambahkelas', [BootcampController::class, 'store'])->name('bootcamp.store');

Route::get('/editkelas/{id}', [BootcampController::class, 'edit'])->name('bootcamp.edit');
Route::put('/editkelas/{id}', [BootcampController::class, 'update'])->name('bootcamp.update');

Route::delete('/hapuskelas', [BootcampController::class, 'destroy'])->name('bootcamp.destroy');

// pirvatementroign
Route::get('/mentoring', [BootcampController::class, 'mentoring'])->name('mentoring.index');
Route::put('/mentoring/{id}', [BootcampController::class, 'update'])->name('mentoring.update');

use App\Http\Controllers\PesertaController;
Route::get('/peserta', [PesertaController::class, 'index'])->name('peserta.index');

use App\Http\Controllers\EventController;
Route::get('/event', [EventController::class, 'index']);
Route::get('/event/tambah', [EventController::class, 'create']);
Route::post('/event/simpan', [EventController::class, 'store']);
Route::get('/event/edit/{id}', [EventController::class, 'edit']);
Route::post('/event/update/{id}', [EventController::class, 'update']);
Route::delete('/event/hapus/{id}', [EventController::class, 'destroy'])->name('event.destroy');

use Illuminate\Support\Facades\Auth;

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');