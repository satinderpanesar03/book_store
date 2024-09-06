<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)->group(function () {
    Route::get('login', 'showLoginForm')->name('login.form');
    Route::post('login', 'login')->name('login');
    Route::get('register', 'showRegisterForm')->name('register.form');
    Route::post('register', 'register')->name('register');
});

Route::get('/', [BookController::class, 'index'])->name('books.index');
Route::get('book/{id}/show', [BookController::class, 'show'])->name('books.show');

Route::group(['middleware' => 'auth'], function () {
    Route::post('logout', [UserController::class, 'logout'])->name('logout');
    Route::post('review',[ReviewController::class, 'store'])->name('review.store');
});

