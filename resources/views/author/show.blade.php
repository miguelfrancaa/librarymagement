@extends('layouts.app')
@section('content')

<div class="container mt-5">
	<div class="row">
		<div class="col-md-6"><img class="w-75" src="{{$author->image}}"></div>
		<div class="col-md-6">
			<div>
				<h1 class="fw-bolder">{{$author->name}}</h1>
				<h2 class="mt-5 h4">{{$author->description}}</h2>
			</div>
		</div>
	</div>
	<div class="row mt-5">
		<div class="h4 col-md-12 mb-4">Books of {{$author->name}}:</div>
			@foreach($books as $book)
				<div class="col-md-4"><img src="{{$book->image}}"><h5 class="fw-bold mt-3">{{ $book->title }}</h5>
				<h6>{{ Str::limit($book->description, 40) }}</h6></div>
			@endforeach
	</div>
</div>

@endsection