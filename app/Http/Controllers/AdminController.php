<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Reserve;
use App\Models\Author;
use App\Models\Category;
use App\Models\User;
use Intervention\Image\ImageManagerStatic as Image;

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

    public function authorsindex(){

       $search = request('search');
    $query = Author::query();

        if($search){
            $query->where('name', 'like', '%' .$search . '%');
        }

        $authors = $query->get();

        return view('admin.author.index', compact('search', 'authors'));

    }

    public function destroybook(Book $book){

        $book->reserved()->detach();

        $book->favorited()->detach();

        $book->delete();

        return redirect('/admin/books');
    }

    public function createbook(){

        $authors = Author::all();

        $categories = Category::all();

        return view('admin.book.create', compact('categories', 'authors'));

    }

    public function storebook(Request $request){

        $bookInputs = $request->validate([
            'title' => ['required', 'max:200'],
            'description' => ['required', 'max:5000'],
            'quantity' => ['required', 'numeric', 'min:0'],
            'bookImage' => 'required|image|mimes:jpg,png,jpeg'
        ]);

        if(empty($request->input('author'))){
            $authorData = $request->validate([
                'newAuthor' => ['required', 'min:2']
            ]);
        }else{
            $authorData = $request->validate([
                'author' => ['required']
            ]);
        }

        $book = new Book;

        if(!empty($request->author)){
            $authorBook = $request->author;
        }else{
            $author = new Author;

            $author->name = $request->newAuthor;

            $author->save();

            $authorBook = $author->id;
        }

        if(!empty($request->category)){
            $categoryBook = $request->category;
        }else{
            $category = new Category;

            $category->name = $request->newCategory;

            $category->save();

            $categoryBook = $category->id;
        }

        if($request->hasFile('bookImage') && $request->file('bookImage')->isValid()){

            $requestImage = $request->file('bookImage');

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . '.' . $extension;


            $img = Image::make($requestImage);
            $img->fit(400, 400);

            $img->save(public_path('img/books') . '/' . $imageName);

        }

        $book->title = $request->title;
        $book->description = $request->description;
        $book->quantity = $request->quantity;
        $book->author_id = $authorBook;
        $book->category_id = $categoryBook;
        $book->image = $imageName;

        $book->save();

        return redirect('/admin/books')->with('success', 'Livro Adicionado com sucesso');
    }

    public function destroyuser(User $user){

        $user->delete();

        return redirect('admin/users')->with('success', 'Reserve deleted successfully.');
    }
}
