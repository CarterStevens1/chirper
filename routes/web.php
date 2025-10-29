<?php

use App\Http\Controllers\ChirpController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ChirpController::class, 'index'])->name('home');

Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store'])->name('register');
Route::get('login', [LoginController::class, 'create'])->name('login');
Route::post('login', [LoginController::class, 'store'])->name('login');
Route::get('edit', [RegisteredUserController::class, 'edit'])->middleware('auth')->name('edit');
Route::post('edit', [RegisteredUserController::class, 'update'])->middleware('auth')->name('update');
Route::post('destroy', [RegisteredUserController::class, 'destroy'])->middleware('auth')->name('destroy');
