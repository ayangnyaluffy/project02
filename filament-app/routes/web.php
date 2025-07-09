<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaChecklistController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/mahasiswa/checklist-update', [MahasiswaChecklistController::class, 'update'])
    ->middleware('auth:mahasiswa')
    ->name('mahasiswa.checklist.update');
