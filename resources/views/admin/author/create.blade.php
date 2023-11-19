@extends('layouts.app')

@section('content')
<div class="container mt-5">
  <h2 class="fw-bold mb-5">New author</h2>
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error) 
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  <form method="POST" action="{{ route('admin.store.author') }}" enctype="multipart/form-data">
    @csrf
  <div class="form-group mb-5">
    <label for="name">Name</label>
    <input max="200" required name="name" type="text" class="form-control" id="name" placeholder="Author's name" value="{{ old('name') }}">
  </div>
   <div class="form-group mb-5">
    <label for="authorDescription">Description</label>
    <textarea class="form-control" id="authorDescription" rows="3" placeholder="Author's description" name="description">{{ old('description') }}</textarea>
  </div>
  <div class="form-group mb-5">
    <label for="authorImage" class="form-label">Image</label>
    <input type="file" class="form-control" name="authorImage">
  </div>
  <button type="submit" class="btn btn-primary">Add Author</button>
</form>
</div>

@endsection