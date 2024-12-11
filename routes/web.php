<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\Tipe_KamarController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Models\Tipe_Kamar;

// landing page
Route::get('/', function () {
    $tipe_kamars = Tipe_Kamar::all();
    return view('user.index',compact('tipe_kamars'));
});

Route::get('/dashboard/kamar',[RoomController::class,'index'])->name('dashboard.kamar');
Route::get('/dashboard/kamar/{id}',[RoomController::class,'show'])->name('dashboard.kamar.show');

Route::post('/api/midtrans/notification', [RoomController::class, 'notificationHandler'])->name('midtrans.notification')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
Route::get('/payment/finish', [RoomController::class, 'finish']);

Route::get('/dashboard', function () {
    $tipe_kamars = Tipe_Kamar::all();
    return view('user.index',compact('tipe_kamars'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // dashboard admin
    Route::get('/dashboard-admin', [DashboardController::class, 'index'])->middleware('admin');
    // routes/web.php
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    
    //user
    Route::get('/admin/user', [UserController::class, 'index'])->name('admin.user')->middleware('admin');
    // pemesanan
    Route::get('/admin/pemesanan', [PemesananController::class, 'index'])->name('admin.pemesanan')->middleware('admin');
    Route::get('/admin/pemesanan/create', [PemesananController::class, 'create'])->name('admin.pemesanan.create')->middleware('admin');
    Route::post('/admin/pemesanan/store', [PemesananController::class, 'store'])->name('admin.pemesanan.store')->middleware('admin');
    Route::get('/admin/pemesanan/edit/{id}',[PemesananController::class,'edit'])->name('admin.pemesanan.edit')->middleware('admin');
    Route::put('/admin/pemesanan/update/{id}',[PemesananController::class,'update'])->name('admin.pemesanan.update')->middleware('admin');
    Route::delete('/admin/pemesanan/delete/{id}',[PemesananController::class,'destroy'])->name('admin.pemesanan.destroy')->middleware('admin');
    // tipe kamar
    Route::get('/admin/tipe_kamar', [Tipe_KamarController::class, 'index'])->name('admin.tipe_kamar')->middleware('admin');
    Route::get('/admin/tipe_kamar/create', [Tipe_KamarController::class, 'create'])->name('admin.tipe_kamar.create')->middleware('admin');
    Route::post('/admin/tipe_kamar/store', [Tipe_KamarController::class, 'store'])->name('admin.tipe_kamar.store')->middleware('admin');
    Route::get('/admin/tipe_kamar/edit/{id}',[Tipe_KamarController::class,'edit'])->name('admin.tipe_kamar.edit')->middleware('admin');
    Route::put('/admin/tipe_kamar/update/{id}',[Tipe_KamarController::class,'update'])->name('admin.tipe_kamar.update')->middleware('admin');
    Route::delete('/admin/tipe_kamar/delete/{id}',[Tipe_KamarController::class,'destroy'])->name('admin.tipe_kamar.destroy')->middleware('admin');

    // kamar
    Route::get('/admin/kamar', [KamarController::class, 'index'])->name('admin.kamar')->middleware('admin');
    Route::get('/admin/kamar/create', [KamarController::class, 'create'])->name('admin.kamar.create')->middleware('admin');
    Route::post('/admin/kamar/store', [KamarController::class, 'store'])->name('admin.kamar.store')->middleware('admin');
    Route::get('admin/kamar/edit/{id}',[KamarController::class,'edit'])->name('admin.kamar.edit')->middleware('admin');
    Route::put('admin/kamar/update/{id}',[KamarController::class,'update'])->name('admin.kamar.update')->middleware('admin');
    Route::delete('admin/kamar/delete/{id}',[KamarController::class,'destroy'])->name('admin.kamar.destroy')->middleware('admin');

    // room user
    Route::get('/dashboard/kamar/create/{id}',[RoomController::class,'create'])->name('dashboard.kamar.create');
    Route::post('/dashboard/kamar/store', [RoomController::class, 'store'])->name('dashboard.kamar.store');
    Route::get('/dashboard/cart',[RoomController::class,'cart'])->name('dashboard.cart');
    Route::get('/checkout/{id}', [RoomController::class, 'checkout'])->name('dashboard.checkout');
    Route::get('/dashboard/kamar/detail-pemesanan/{id}',[RoomController::class,'detailPesanan'])->name('dashboard.kamar.detail-kamar');
    
});



require __DIR__.'/auth.php';



