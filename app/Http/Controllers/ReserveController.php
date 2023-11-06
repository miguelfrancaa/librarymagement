<?php

namespace App\Http\Controllers;

use App\Models\Reserve;
use App\Models\Book;
use Illuminate\Http\Request;

class ReserveController extends Controller
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
        $user = auth()->user();
        $book = Book::find($request->book_id);

        if ($user->reserves->contains($book)) {
            $user->reserves()->detach($book);
            return redirect()->back()->with('success', 'Book reservation removed.');
        } else {
            $user->reserves()->attach($book);
            return redirect()->back()->with('success', 'Book reserved.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Reserve $reserve)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reserve $reserve)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reserve $reserve)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reserve $reserve)
    {
        //
    }
}
