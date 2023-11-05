@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
@foreach($books as $book)
            <div class="col-md-4 col-sm-4 col-xs-12 d-flex justify-content-center">
                <div class="card" style="width: 100%; margin-bottom: 30px; max-width: 300px;">
                 <img class="card-img-top" src="{{ $book->image }}" alt="Card image cap">
                 <div class="card-body">
             <h5 class="card-title">{{ $book->title }}</h5>
             <h6>{{ $book->author->name }}</h6>
             <p class="card-text">{{ Str::limit($book->description, 55) }}</p>
             <a href="{{ route('book.show', [$book]) }}" class="btn btn-primary">See +</a>
       </div>
                </div>
            </div>
@endforeach
        @if(count($books) == 0)
        <h3 class="mt-2">No results for your search.</h3>
        @endif
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
            {{ $books->links() }}
            </div>
        </div>
    </div>

@endsection