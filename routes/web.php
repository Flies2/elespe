<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('kategori', KategoriController::class)->middleware('auth');

Route::resource('item', ItemController::class)->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::post('/transaksi/tambah', [TransaksiController::class, 'tambah'])->name('transaksi.tambah');
    Route::post('/transaksi/hapus', [TransaksiController::class, 'hapus'])->name('transaksi.hapus');
    Route::post('/transaksi/selesai', [TransaksiController::class, 'selesai'])->name('transaksi.selesai');
});

Route::get('/transaksi/struk/{id}', [TransaksiController::class, 'struk'])->name('transaksi.struk');

Route::get('/item', [ItemController::class, 'index'])->name('item.index');

Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');

Route::get('/transaksi/riwayat', [TransaksiController::class, 'riwayat'])->name('transaksi.riwayat');

Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');


require __DIR__.'/auth.php';
