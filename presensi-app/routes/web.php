<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PresensiController;

Route::get('/', function () {
    return redirect()->route('presensi.index');
});

Route::resource('presensi', PresensiController::class);
