<?php

use App\Http\Controllers\ChirpController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ChirpController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('edit', [RegisteredUserController::class, 'edit'])->name('edit');
    Route::patch('edit', [RegisteredUserController::class, 'update'])->name('update');
    Route::delete('destroy', [RegisteredUserController::class, 'destroy'])->name('destroy');

    Route::get('chirp-create', [ChirpController::class, 'create'])->name('chirp-create');
    Route::post('chirp-create', [ChirpController::class, 'store'])->name('chirp-create');

    // Need to create
    // Route::get('dashboard');
    // Route::get('chirp/{id}');
    // Route::get('chirp/{id}/edit');
    // Route::patch('chirp/{id});
    // Route::delete('chirp/{id});

    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store'])->name('register');

    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store'])->name('login');
});
