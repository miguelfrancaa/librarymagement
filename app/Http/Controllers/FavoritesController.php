<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class FavoritesController extends Controller
{
    public function store(Book $book){

        return auth()->user()->favorites()->toggle( $book );

    }

    public function index(){ 

        $user = auth()->user();
        $books = $user->favorites()->paginate(6);

        return view('favorite.index', compact('books'));
    }
}
