<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $btn = '';

        if(auth()->check()){
        $favoritedOrNot = $book->favorited()
                                ->where('user_id', auth()->user()->id)
                                ->get();

        if($favoritedOrNot->count() == 0){
            $btn = 'add';
        }else{
            $btn = 'remove';
        }

        $reservedOrNot = $book->reserved()
                              ->where('user_id', auth()->user()->id)
                              ->get();

        if($reservedOrNot->count() == 0){
            $reserveBtn = 'add';
        }else{
            $reserveBtn = 'remove';
        }
    }

        return view('book.show', compact('book', 'btn', 'reserveBtn'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
}
