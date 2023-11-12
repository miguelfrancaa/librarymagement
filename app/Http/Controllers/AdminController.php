<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Reserve;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.index');
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function booksindex()
    {
        $search = request('search');
        $query = Book::query();

        if ($search) {
        $query->where('title', 'like', '%' . $search . '%')
          ->orWhereHas('author', function ($query) use ($search) {
              $query->where('name', 'like', '%' . $search . '%');
          });
        }

        $books = $query->get();

        return view('admin.book.index', compact('books', 'search'));
    }

    public function usersindex()
    {
        $search = request('search');
        $query = User::query();

        if($search){
            $query->where('firstname', 'like', '%' .$search . '%')
            ->orWhere('lastname', 'like', '%' .$search . '%');
        }

        $users = $query->get();

        return view('admin.user.index', compact('users', 'search'));
    }

    public function reservesindex()
    {
        $search = request('search');
        $query = Reserve::query();

        if ($search) {
        $query->whereHas('user', function ($userQuery) use ($search) {
            $userQuery->where(function ($nameQuery) use ($search) {
                $nameQuery->whereRaw("CONCAT(firstname, ' ', lastname) LIKE ?", ["%{$search}%"]);
            });
        });
    }

        $reserves = $query->get();

        return view('admin.reserve.index', compact('search', 'reserves'));
    }

    public function deletereserves(){

    $threeDaysAgo = now()->subDays(3);

    $reserves = Reserve::where('created_at', '<', $threeDaysAgo)->get();

    foreach($reserves as $reserve){

        $book = $reserve->book;

        $book->increment('quantity', 1);

        $reserve->delete();
    }

    return redirect('admin/reserves');

    }

    public function destroyreserve(Reserve $reserve){

        $reserve->book->increment('quantity', 1);

        $reserve->delete();

        return redirect('admin/reserves')->with('success', 'Reserve deleted successfully.');
    }
}
