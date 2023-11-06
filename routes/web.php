<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('category.show');

Route::get('/books/{book}', [BookController::class, 'show'])->name('book.show');

Route::post('/favorite/{book}', [FavoritesController::class, 'store'])->name('favorite.store')->middleware('auth');

Route::get('/favorites', [FavoritesController::class, 'index'])->name('favorite.index')->middleware('auth');

Route::get('/contact', [ContactController::class, 'create'])->name('contact.create')->middleware('auth');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store')->middleware('auth');
