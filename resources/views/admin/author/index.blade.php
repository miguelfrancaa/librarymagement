@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row mt-5 mb-5">
    	<form class="col-md-6" action="{{ route('admin.authors.index') }}" method="get">
        <div class="input-group">
    	    <input name="search" type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon"/>
          <button type="submit" class="btn btn-outline-primary">search</button><br>
        </div>
    	</form>
    	<div class="col-md-6">
     	   <a href="{{ route('admin.create.author') }}">
     	       <button class="btn btn-primary" style="float: right;">New author +</button>
     	   </a>
    	</div>
    	@if($search)
    	    <div class="col-md-12">
    	        <h6 class="searching">You are searching for '{{ $search }}'</h6>
    	    </div>  
    	@endif
	</div>
  <div class="row">
	<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#ID</th>
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col" colspan="2">Actions</th>
    </tr>
  </thead>
  <tbody>
@foreach($authors as $author)
	<tr>
      <th scope="row">{{ $author->id }}</th>
      <td>{{ $author->name }}</td>
      <td>{{ Str::limit($author->description, 50) }}</td>
     <td>
        <a href="{{ route('admin.edit.author', [$author] ) }}"><button class="btn btn-warning btn-sm">Edit</button></a>
      </td>
     <td><form action='' method="POST">
        @csrf
        @method('DELETE')
        <button onclick="return confirm('Do you really want to delete this author?')" class="btn btn-danger btn-sm" type="submit">Delete</button></form>
      </td>
    </tr>
@endforeach
  </tbody>
</table>
</div>
@if(count($authors) == 0)
        <h3 class="mt-2">No results for your search.</h3>
@endif
</div>

@endsection