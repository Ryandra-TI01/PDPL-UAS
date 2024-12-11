<?php

use App\Http\Controllers\KamarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\Tipe_KamarController;
use App\Http\Controllers\PembayaranController;


Route::get('/dashboard', function () {
    return view('/admin/dashboard/index');
});



Route::get('/dashboard/pemesanan', [PemesananController::class, 'index'])->name('dashboard.pemesanan');
Route::get('/admin/pemesanan/create', [PemesananController::class, 'create'])->name('admin.pemesanan.create');

// tipe kamar
Route::get('/admin/tipe_kamar', [Tipe_KamarController::class, 'index'])->name('admin.tipe_kamar');
Route::get('/admin/tipe_kamar/create', [Tipe_KamarController::class, 'create'])->name('admin.tipe_kamar.create');
Route::post('/admin/tipe_kamar/store', [Tipe_KamarController::class, 'store'])->name('admin.tipe_kamar.store');
Route::get('/admin/tipe_kamar/edit/{id}',[Tipe_KamarController::class,'edit'])->name('admin.tipe_kamar.edit');
Route::put('/admin/tipe_kamar/update/{id}',[Tipe_KamarController::class,'update'])->name('admin.tipe_kamar.update');
Route::delete('/admin/tipe_kamar/delete/{id}',[Tipe_KamarController::class,'destroy'])->name('admin.tipe_kamar.destroy');

// kamar
Route::get('/admin/kamar', [KamarController::class, 'index'])->name('admin.kamar');
Route::get('/admin/kamar/create', [KamarController::class, 'create'])->name('admin.kamar.create');
Route::post('/admin/kamar/store', [KamarController::class, 'store'])->name('admin.kamar.store');
Route::get('admin/kamar/edit/{id}',[KamarController::class,'edit'])->name('admin.kamar.edit');
Route::put('admin/kamar/update/{id}',[KamarController::class,'update'])->name('admin.kamar.update');
Route::delete('admin/kamar/delete/{id}',[KamarController::class,'destroy'])->name('admin.kamar.destroy');


Route::get('/admin/pembayaran', [PembayaranController::class, 'index'])->name('admin.pembayaran');
Route::get('/admin/pembayaran/create', [PembayaranController::class, 'create'])->name('admin.pembayaran.create');
Route::get('/admin/pembayaran/edit/{id}', [PembayaranController::class, 'edit'])->name('admin.pembayaran.edit');
Route::post('/admin/pembayaran/update/{id}', [PembayaranController::class, 'update'])->name('admin.pembayaran.update');
Route::get('/admin/pembayaran/delete/{id}', [PembayaranController::class, 'destroy'])->name('admin.pembayaran.destroy');
