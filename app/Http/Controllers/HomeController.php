<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\Author;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $search = request('search');
        $query = Book::query();

        if ($search) {
        $query->where('title', 'like', '%' . $search . '%')
          ->orWhereHas('author', function ($query) use ($search) {
              $query->where('name', 'like', '%' . $search . '%');
          });
        }

        $books = $query->paginate(6);

        $categories = Category::all();

        return view('home', compact('books', 'search', 'categories'));
    }
}
