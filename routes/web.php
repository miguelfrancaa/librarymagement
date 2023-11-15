<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\AdminController;

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

Route::get('/author/{author}', [AuthorController::class, 'show'])->name('author.show');

Route::post('/favorite/{book}', [FavoritesController::class, 'store'])->name('favorite.store')->middleware('auth');

Route::get('/favorites', [FavoritesController::class, 'index'])->name('favorite.index')->middleware('auth');

Route::get('/contact', [ContactController::class, 'create'])->name('contact.create')->middleware('auth');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store')->middleware('auth');

Route::post('/reserve', [ReserveController::class, 'store'])->name('reserve.store')->middleware('auth');

Route::get('/reserves', [ReserveController::class, 'index'])->name('reserves.index')->middleware('auth');

Route::delete('/reserve/{reserve}', [ReserveController::class, 'destroy'])->name('reserve.destroy')->middleware('auth');

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    Route::get('/books', [AdminController::class, 'booksindex'])->name('admin.books.index');

    Route::get('/users', [AdminController::class, 'usersindex'])->name('admin.users.index');

    Route::delete('/user/{user}', [AdminController::class, 'destroyuser'])->name('admin.destroy.user');

    Route::get('/reserves', [AdminController::class, 'reservesindex'])->name('admin.reserves.index');

    Route::get('/reserves/delete', [AdminController::class, 'deletereserves'])->name('admin.delete.reserves');

    Route::delete('/reserve/{reserve}', [AdminController::class, 'destroyreserve'])->name('admin.destroy.reserve');

    Route::get('/authors', [AdminController::class, 'authorsindex'])->name('admin.authors.index');

    Route::delete('/book/{book}', [AdminController::class, 'destroybook'])->name('admin.destroy.book');

    Route::get('/book/create', [AdminController::class, 'createbook'])->name('admin.create.book');

    Route::post('/book/store', [AdminController::class, 'storebook'])->name('admin.store.book');
});
