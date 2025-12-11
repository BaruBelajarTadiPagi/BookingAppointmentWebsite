<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\PresenceDetailController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.index');
})->name('home');


// admin routes
Route::resource('presence', PresenceController ::class);
Route::delete('presence-detail/{id}', [PresenceDetailController::class, 'destroy'])->name('presence-detail.destroy');
Route::get('presence-detail/export-pdf/{id}', [PresenceDetailController::class, 'exportPdf'])->name('presence-detail.export-pdf');

// client routes
Route::get('absensi/{slug}', [AbsensiController::class, 'index'])->name('absensi.index');
Route::post('absensi/save/{id}', [AbsensiController::class, 'save'])->name('absensi.save');
