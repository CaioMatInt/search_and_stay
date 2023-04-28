<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookstoreBookController;
use App\Http\Controllers\BookstoreController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('users')->group(function () {
    Route::post('login', [UserController::class, 'login'])->name('user.login');
    Route::get('login/{provider_name}', [
        UserController::class, 'redirectToLoginWithProvider'
    ])->name('user.login.provider');

    Route::get('login/{provider_name}/callback', [
        UserController::class, 'loginCallbackOfProvider'
    ])->name('user.login.provider.callback');

    Route::post('register', [UserController::class, 'register'])->name('user.register');
    Route::post('password/forgot', [UserController::class, 'sendPasswordResetLinkEmail'])->name('user.password.forgot');
    Route::post('password/reset', [UserController::class, 'resetPassword'])->name('user.password.reset');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [UserController::class, 'logout'])->name('user.logout');
        Route::get('me', [UserController::class, 'getAuthenticatedUser'])->name('user.me');
        Route::post('{id}/update', [UserController::class, 'update'])->name('user.update');
    });
});

Route::middleware(['auth:sanctum', 'is.administrator'])->group(function () {
    Route::resource('books', BookController::class)->only(['index', 'store', 'update', 'show', 'destroy']);
    Route::get('bookstores', [BookstoreController::class, 'index'])->name('bookstores.index');

    Route::resource('bookstore-books', BookstoreBookController::class)->only(['store', 'destroy']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('bookstore-books/rent', [BookstoreBookController::class, 'rent'])->name('bookstores.rent');
    Route::post('bookstore-books/{id}/give-back', [BookstoreBookController::class, 'giveBack'])->name('bookstores.giveBack');
});
