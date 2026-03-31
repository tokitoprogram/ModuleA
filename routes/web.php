<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Auth;


Route::middleware('guest')->group(function() {

// Вход
    Route::view('login', 'login')->name('login');
    Route::post('login', LoginController::class)->name('login.attempt');

// Регистрация
    Route::view('registration', 'registration')->name('registration');
    Route::post('registration', RegistrationController::class)->name('registration.attempt');
});

// Home
Route::get('/', [BookController::class, 'index'])->name('home');


// Страницы доступные только для аторизованных
Route::middleware('auth')->group(function () {



    // Logout
    Route::post('logout', LogoutController::class)->name('logout');

    Route::controller(BookController::class)->prefix('/book')->group(function (){
        // Создание книги
        Route::get('/create',  'create')->name('book.create');
        Route::post('/create', 'store')->name('book.store');
        // Показать конкретную книгу
        Route::get('/{book}', 'show')->name('book.show');
        // Редактировать конкретную книгу
        Route::get('/{book}/edit', 'edit')->name('book.edit');
        // Удаление книги
        Route::post('/{book}/destroy', 'destroy')->name('book.destroy');
        // Изменить данные книги
        Route::put('/{book}/update', 'update')->name('book.update');

    });

});

