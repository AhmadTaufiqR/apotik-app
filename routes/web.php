<?php

use App\Http\Controllers\ApotekerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\SuplierController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::get('/register', function () {
    return view('register.register');
});

//Rpute untuk Apoteker
Route::get('/apoteker', [ApotekerController::class, 'index'])->name('apoteker.index');
Route::get('/apoteker/search', [ApotekerController::class, 'search'])->name('apoteker.search');
Route::get('/apoteker/create', [ApotekerController::class, 'create'])->name('apoteker.create');
Route::post('/apoteker', [ApotekerController::class, 'store'])->name('apoteker.store');
Route::get('/apoteker/{id}/edit', [ApotekerController::class, 'edit'])->name('apoteker.edit');
Route::get('/apoteker/{id}/detail', [ApotekerController::class, 'detail'])->name('apoteker.detail');
Route::put('/apoteker/{id}', [ApotekerController::class, 'update'])->name('apoteker.update');
Route::post('/apoteker/delete', [ApotekerController::class, 'destroyMulti'])->name('apoteker.destroy.multi');

//Route untuk Suplier
Route::get('/suplier', [SuplierController::class, 'index'])->name('suplier.index');
Route::get('/suplier/search', [SuplierController::class, 'search'])->name('suplier.search');
Route::get('/suplier/create', [SuplierController::class, 'create'])->name('suplier.create');
Route::post('/suplier', [SuplierController::class, 'store'])->name('suplier.store');
Route::get('/suplier/{id}/edit', [SuplierController::class, 'edit'])->name('suplier.edit');
Route::get('/suplier/{id}/detail', [SuplierController::class, 'detail'])->name('suplier.detail');
Route::put('/suplier/{id}', [SuplierController::class, 'update'])->name('suplier.update');
Route::post('/suplier/delete', [SuplierController::class, 'destroyMulti'])->name('suplier.destroy.multi');

//Route untuk Pelanggan
Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
Route::get('/pelanggan/search', [PelangganController::class, 'search'])->name('pelanggan.search');
Route::get('/pelanggan/create', [PelangganController::class, 'create'])->name('pelanggan.create');
Route::post('/pelanggan', [PelangganController::class, 'store'])->name('pelanggan.store');
Route::get('/pelanggan/{id}/edit', [PelangganController::class, 'edit'])->name('pelanggan.edit');
Route::get('/pelanggan/{id}/detail', [PelangganController::class, 'detail'])->name('pelanggan.detail');
Route::put('/pelanggan/{id}', [PelangganController::class, 'update'])->name('pelanggan.update');
Route::post('/pelanggan/delete', [PelangganController::class, 'destroyMulti'])->name('pelanggan.destroy.multi');

//Route untuk Obat
Route::get('/obat', [ObatController::class, 'index'])->name('obat.index');
Route::get('/obat/search', [ObatController::class, 'search'])->name('obat.search');
Route::get('/obat/create', [ObatController::class, 'create'])->name('obat.create');
Route::post('/obat', [ObatController::class, 'store'])->name('obat.store');
Route::get('/obat/{id}/edit', [ObatController::class, 'edit'])->name('obat.edit');
Route::get('/obat/{id}/detail', [ObatController::class, 'detail'])->name('obat.detail');
Route::put('/obat/{id}', [ObatController::class, 'update'])->name('obat.update');
Route::post('/obat/delete', [ObatController::class, 'destroyMulti'])->name('obat.destroy.multi');
