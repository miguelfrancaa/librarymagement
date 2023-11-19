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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('isActive');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('isActive');

Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('category.show')->middleware('isActive');

Route::get('/books/{book}', [BookController::class, 'show'])->name('book.show')->middleware('isActive');

Route::get('/author/{author}', [AuthorController::class, 'show'])->name('author.show')->middleware('isActive');

Route::get('/blocked', [App\Http\Controllers\HomeController::class, 'blocked'])->name('blocked')->middleware('isActive');

Route::post('/favorite/{book}', [FavoritesController::class, 'store'])->name('favorite.store')->middleware(['auth', 'isActive']);

Route::get('/favorites', [FavoritesController::class, 'index'])->name('favorite.index')->middleware(['auth', 'isActive']);

Route::get('/contact', [ContactController::class, 'create'])->name('contact.create')->middleware(['auth', 'isActive']);

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store')->middleware(['auth', 'isActive']);

Route::post('/reserve', [ReserveController::class, 'store'])->name('reserve.store')->middleware(['auth', 'isActive']);

Route::get('/reserves', [ReserveController::class, 'index'])->name('reserves.index')->middleware(['auth', 'isActive']);

Route::delete('/reserve/{reserve}', [ReserveController::class, 'destroy'])->name('reserve.destroy')->middleware(['auth', 'isActive']);

Route::group(['prefix' => 'admin', 'middleware' => ['admin', 'isActive']], function() {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    Route::get('/books', [AdminController::class, 'booksindex'])->name('admin.books.index');

    Route::get('/users', [AdminController::class, 'usersindex'])->name('admin.users.index');

    Route::delete('/user/{user}', [AdminController::class, 'destroyuser'])->name('admin.destroy.user');

    Route::put('/user/{user}', [AdminController::class, 'blockuser'])->name('admin.block.user');

    Route::get('/reserves', [AdminController::class, 'reservesindex'])->name('admin.reserves.index');

    Route::get('/reserves/delete', [AdminController::class, 'deletereserves'])->name('admin.delete.reserves');

    Route::delete('/reserve/{reserve}', [AdminController::class, 'destroyreserve'])->name('admin.destroy.reserve');

    Route::get('/authors', [AdminController::class, 'authorsindex'])->name('admin.authors.index');

    Route::delete('/book/{book}', [AdminController::class, 'destroybook'])->name('admin.destroy.book');

    Route::get('/book/create', [AdminController::class, 'createbook'])->name('admin.create.book');

    Route::post('/book/store', [AdminController::class, 'storebook'])->name('admin.store.book');

    Route::get('/author', [AdminController::class, 'createauthor'])->name('admin.create.author');

    Route::post('/author', [AdminController::class, 'storeauthor'])->name('admin.store.author');

    Route::get('/author/{author}', [AdminController::class, 'editauthor'])->name('admin.edit.author');

    Route::put('/author/{author}', [AdminController::class, 'updateautor'])->name('admin.update.author');
});
