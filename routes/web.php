<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanBanjirController;

Route::get('/', function () {
    return redirect()->route('laporan.form');
});

Route::get('/laporan', [LaporanBanjirController::class, 'form'])->name('laporan.form');

Route::post('/laporan/kirim', [LaporanBanjirController::class, 'kirim'])->name('laporan.kirim');

Route::get('/laporan/kirim', function () {
    return redirect()->route('laporan.form');
});

