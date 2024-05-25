<?php

use App\Http\Controllers\ApotekerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardPelangganController;
use App\Http\Controllers\DetailPembelianController;
use App\Http\Controllers\DetailPenjualanController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
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

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register');

Route::middleware(['role:Admin|Apoteker'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
});

Route::get('/dashboard-pelanggan', [DashboardPelangganController::class, 'index'])->name('dashboard-pelanggan.index');
Route::get('/dashboard-pelanggan/search', [DashboardPelangganController::class, 'search'])->name('dashboard-pelanggan.search');


Route::middleware(['role:Admin'])->group(function () {

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

    Route::get('/pembelian', [PembelianController::class, 'index'])->name('pembelian.index');
    Route::get('/pembelian/search', [PembelianController::class, 'search'])->name('pembelian.search');
    Route::get('/pembelian/create', [PembelianController::class, 'create'])->name('pembelian.create');
    Route::post('/pembelian', [PembelianController::class, 'store'])->name('pembelian.store');
    Route::get('/pembelian/{id}/edit', [PembelianController::class, 'edit'])->name('pembelian.edit');
    Route::get('/pembelian/{id}/detail', [PembelianController::class, 'detail'])->name('pembelian.detail');
    Route::put('/pembelian/{id}', [PembelianController::class, 'update'])->name('pembelian.update');
    Route::post('/pembelian/delete', [PembelianController::class, 'destroyMulti'])->name('pembelian.destroy.multi');
    Route::get('/detail-pembelian/{id}/show', [DetailPembelianController::class, 'index'])->name('detail-pembelian.index');
    Route::post('/detail-pembelian/store', [DetailPembelianController::class, 'store'])->name('detail-pembelian.store');
});

Route::middleware(['role:Apoteker|Admin'])->group(function () {
    //Route untuk Obat
    Route::get('/obat', [ObatController::class, 'index'])->name('obat.index');
    Route::get('/obat/search', [ObatController::class, 'search'])->name('obat.search');
    Route::get('/obat/create', [ObatController::class, 'create'])->name('obat.create');
    Route::post('/obat', [ObatController::class, 'store'])->name('obat.store');
    Route::get('/obat/{id}/edit', [ObatController::class, 'edit'])->name('obat.edit');
    Route::get('/obat/{id}/detail', [ObatController::class, 'detail'])->name('obat.detail');
    Route::put('/obat/{id}', [ObatController::class, 'update'])->name('obat.update');
    Route::post('/obat/delete', [ObatController::class, 'destroyMulti'])->name('obat.destroy.multi');
});


Route::middleware(['role:Apoteker'])->group(function () {
    Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
    Route::get('/penjualan/search', [PenjualanController::class, 'search'])->name('penjualan.search');
    Route::get('/penjualan/create', [PenjualanController::class, 'create'])->name('penjualan.create');
    Route::post('/penjualan', [PenjualanController::class, 'store'])->name('penjualan.store');
    Route::get('/penjualan/{id}/edit', [PenjualanController::class, 'edit'])->name('penjualan.edit');
    Route::get('/penjualan/{id}/detail', [PenjualanController::class, 'detail'])->name('penjualan.detail');
    Route::put('/penjualan/{id}', [PenjualanController::class, 'update'])->name('penjualan.update');
    Route::post('/penjualan/delete', [PenjualanController::class, 'destroyMulti'])->name('penjualan.destroy.multi');
    Route::get('/detail-penjualan/{id}/show', [DetailPenjualanController::class, 'index'])->name('detail-penjualan.index');
    Route::post('/detail-penjualan/store', [DetailPenjualanController::class, 'store'])->name('detail-penjualan.store');
});




// Route::get('/detail-penjualan/search', [DetailPenjualanController::class, 'search'])->name('detail-penjualan.search');
// Route::get('/detail-penjualan/create', [DetailPenjualanController::class, 'create'])->name('detail-penjualan.create');
// Route::post('/detail-penjualan', [DetailPenjualanController::class, 'store'])->name('detail-penjualan.store');
// Route::get('/detail-penjualan/{id}/edit', [DetailPenjualanController::class, 'edit'])->name('detail-penjualan.edit');
// Route::get('/detail-penjualan/{id}/detail', [DetailPenjualanController::class, 'detail'])->name('detail-penjualan.detail');
// Route::put('/detail-penjualan/{id}', [DetailPenjualanController::class, 'update'])->name('detail-penjualan.update');
// Route::post('/detail-penjualan/delete', [DetailPenjualanController::class, 'destroyMulti'])->name('detail-penjualan.destroy.multi');


// Route::get('/detail-pembelian', [DetailPembelianController::class, 'index'])->name('detail-pembelian.index');
// Route::get('/detail-pembelian/search', [DetailPembelianController::class, 'search'])->name('detail-pembelian.search');
// Route::get('/detail-pembelian/create', [DetailPembelianController::class, 'create'])->name('detail-pembelian.create');
// Route::post('/detail-pembelian', [DetailPembelianController::class, 'store'])->name('detail-pembelian.store');
// Route::get('/detail-pembelian/{id}/edit', [DetailPembelianController::class, 'edit'])->name('detail-pembelian.edit');
// Route::get('/detail-pembelian/{id}/detail', [DetailPembelianController::class, 'detail'])->name('detail-pembelian.detail');
// Route::put('/detail-pembelian/{id}', [DetailPembelianController::class, 'update'])->name('detail-pembelian.update');
// Route::post('/detail-pembelian/delete', [DetailPembelianController::class, 'destroyMulti'])->name('detail-pembelian.destroy.multi');