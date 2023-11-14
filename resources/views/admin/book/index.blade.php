@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row mt-5 mb-5">
    	<form class="col-md-6" action="{{ route('admin.books.index') }}" method="get">
    	@csrf
        <div class="input-group">
    	    <input name="search" type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon"/>
          <button type="submit" class="btn btn-outline-primary">search</button><br>
        </div>
    	</form>
    	<div class="col-md-6">
     	   <a href="#">
     	       <button class="btn btn-primary" style="float: right;">New book +</button>
     	   </a>
    	</div>
    	@if($search)
    	    <div class="col-md-12">
    	        <h6 class="searching">You are searching for '{{ $search }}'</h6>
    	    </div>  
    	@endif
	</div>
	<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#ID</th>
      <th scope="col">Title</th>
      <th scope="col">Author</th>
      <th scope="col" colspan="2">Actions</th>
    </tr>
  </thead>
  <tbody>
@foreach($books as $book)
	<tr>
      <th scope="row">{{ $book->id }}</th>
      <td>{{ $book->title }}</td>
      <td>{{ $book->author->name }}</td>
     <td><form action='' method="POST">
        @csrf
        <button class="btn btn-warning btn-sm" type="submit">Edit</button></form>
      </td>
     <td><form action='{{ route('admin.destroy.book', [$book]) }}' method="POST">
        @csrf
        @method('DELETE')
        <button onclick="return confirm('Do you really want to delete this book?')" class="btn btn-danger btn-sm" type="submit">Delete</button></form>
      </td>
    </tr>
@endforeach
  </tbody>
</table>
@if(count($books) == 0)
        <h3 class="mt-2">No results for your search.</h3>
@endif
</div>

@endsection