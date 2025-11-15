<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\CartController;

Route::get('/', [MenuController::class, 'showMenuPelanggan']);

Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');

Route::get('/menu/tambah', [MenuController::class, 'tambah'])->name('menu.tambah'); 
Route::post('/menu/store', [MenuController::class, 'store'])->name('menu.store'); 
Route::get('/menu/edit/{id}', [MenuController::class, 'edit'])->name('menu.edit'); 
Route::post('/menu/update/{id}', [MenuController::class, 'update'])->name('menu.update'); 
Route::get('/menu/hapus/{id}', [MenuController::class, 'hapus'])->name('menu.hapus'); 

Route::get('/menu/search', [MenuController::class, 'search'])->name('menu.search'); 
Route::get('/menu/filter-rating', [MenuController::class, 'filterRating'])->name('menu.filterRating'); 

Route::get('/menu/{id}', [MenuController::class, 'detail'])->name('menu.detail'); 

Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add'); 
Route::get('/cart', [CartController::class, 'index'])->name('cart.index'); 
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove'); 
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update'); 
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear'); 
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout'); 

Route::post('/ulasan', [UlasanController::class, 'store'])->name('ulasan.store'); 
Route::get('/ulasan/edit/{id}', [UlasanController::class, 'edit'])->name('ulasan.edit'); 
Route::put('/ulasan/update/{id}', [UlasanController::class, 'update'])->name('ulasan.update'); 
Route::delete('/ulasan/delete/{id}', [UlasanController::class, 'destroy'])->name('ulasan.delete'); 