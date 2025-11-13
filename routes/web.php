<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;


Route::get('/', function () {
    return "Ini Halaman Home"; 
});


Route::get('/menu', [MenuController::class, 'index']);
Route::get('/menu/tambah', [MenuController::class, 'tambah']); // Halaman form TAMBAH
Route::post('/menu/store', [MenuController::class, 'store']); // Nyimpen TAMBAH
Route::get('/menu/edit/{id}', [MenuController::class, 'edit']); // Halaman form EDIT
Route::post('/menu/update/{id}', [MenuController::class, 'update']); // Nyimpen EDIT
Route::get('/menu/hapus/{id}', [MenuController::class, 'hapus']); // HAPUS