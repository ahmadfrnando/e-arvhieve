<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\DownloadController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/download-surat-masuk/{record}', [DownloadController::class, 'downloadsuratmasuk'] )->name('download.surat-masuk'); 
Route::get('/download-surat-keluar/{record}', [DownloadController::class, 'downloadsuratkeluar'] )->name('download.surat-keluar'); 
Route::get('/laporan-surat-masuk', [PDFController::class, 'cetaksuratmasuk'])->name('download.laporan-surat-masuk'); 
Route::get('/laporan-surat-keluar', [PDFController::class, 'cetaksuratkeluar'])->name('download.laporan-surat-keluar'); 