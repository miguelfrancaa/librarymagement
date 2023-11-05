<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class FavoritesController extends Controller
{
    public function store(Book $book){

        return auth()->user()->favorites()->toggle( $book );

    }
}
