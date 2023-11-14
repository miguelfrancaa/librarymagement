@extends('layouts.app')

@section('content')
<div class="container mt-5">
  <h2 class="fw-bold mb-5">New book</h2>
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  <form method="POST" action="" enctype="multipart/form-data">
    @csrf
  <div class="form-group mb-5">
    <label for="titulo">Title</label>
    <input max="200" required name="title" type="text" class="form-control" id="title" placeholder="Book's title">
  </div>
  <div class="form-group mb-5">
    <label for="autor">Author</label>
    <select multiple class="form-control" id="author" name="author">
@foreach($authors as $author)
  <option value="{{ $author->id }}">{{ $author->name }}</option>
@endforeach
    </select>
    <div class="mt-3"><button type="button" class="btn btn-primary btn-sm" id="newAuthorBtn">New author</button><input type="text" name="newAuthor" class="form-control mt-2" id="newAuthor" style="width: 30%; display: none;" placeholder="Insert new author"><button style="display: none;" class="btn btn-primary btn-sm mt-3" id="newAuthorButtonPost">New Author +</button></div>
  </div>
   <div class="form-group mb-5">
    <label for="bookDescription">Description</label>
    <textarea class="form-control" id="bookDescription" rows="3" placeholder="Book's description" name="description"></textarea>
  </div>
  <div class="form-group mb-5">
    <label for="bookQuantity">Quantity</label>
    <input type="number" id="bookQuantity" class="form-control" name="quantity">
  </div>
  <div class="form-group mb-5">
    <label for="bookImage" class="form-label">Image</label>
    <input type="file" class="form-control" name="bookImage">
  </div>
  <div class="form-group mb-5">
    <label for="category">Category</label>
    <select multiple class="form-control" id="category" name="category">
@foreach($categories as $category)
  <option value="{{ $category->id }}">{{ $category->name }}</option>
@endforeach
    </select>
    <div class="mt-3"><button type="button" class="btn btn-primary btn-sm" id="newCategoryBtn">New category +</button><input type="text" name="newCategory" class="form-control mt-2" id="newCategory" style="width: 30%; display: none;" placeholder="Insert a new category"><button style="display: none;" class="btn btn-primary btn-sm mt-3" id="newCategoryButtonPost">New category +</button></div>
  </div>
  <button type="submit" class="btn btn-primary">Add book</button>
</form>
</div>
<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function () {
    let newAuthorBtn = document.getElementById('newAuthorBtn');
    let newAuthor = document.getElementById('newAuthor');
    let newAuthorButtonPost = document.getElementById('newAuthorButtonPost')

    newAuthorBtn.onclick = function () {
        newAuthor.style.display = 'block';
        newAuthorBtn.style.display = 'none';
        newAuthorButtonPost.style.display = 'block';
    }

    let newCategoryBtn = document.getElementById('newCategoryBtn');
    let newCategory = document.getElementById('newCategory');
    let newCategoryButtonPost = document.getElementById('newCategoryButtonPost')

    newCategoryBtn.onclick = function () {
        newCategory.style.display = 'block';
        newCategoryBtn.style.display = 'none';
        newCategoryButtonPost.style.display = 'block';
    }
});
</script>

@endsection