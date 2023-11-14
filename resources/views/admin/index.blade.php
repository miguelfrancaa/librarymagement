@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row" style="height: 80vh;">
			<div class="col-md-6 card h-50 mb-3 perfectCover border border-white border-5 rounded" style="background-image: url(/img/booksadmin.png);"><a href="{{route('admin.books.index')}}"><h2 class="position-absolute bottom-0 start-0 ms-3 mb-3 fw-bold text-dark"><button class="btn btn-light btn-lg">Books</h2></button></a></div>
			<div class="col-md-6 card h-50 mb-3 perfectCover border border-white border-5 rounded" style="background-image: url(/img/usersadmin.jpg);"><a href="{{route('admin.users.index')}}"><h2 class="position-absolute bottom-0 start-0 ms-3 mb-3 fw-bold text-dark"><button class="btn btn-light btn-lg">Users</h2></button></a></div>
			<div class="col-md-6 card h-50 mb-3 perfectCover border border-white border-5 rounded" style="background-image: url(/img/reservesadmin.png);"><a href="{{route('admin.reserves.index')}}"><h2 class="position-absolute bottom-0 start-0 ms-3 mb-3 fw-bold text-dark"><button class="btn btn-light btn-lg">Reserves</h2></button></a></div>
			<div class="col-md-6 card h-50 mb-3 perfectCover border border-white border-5 rounded" style="background-image: url(/img/authorsadmin.png);"><a href="{{route('admin.authors.index')}}"><h2 class="position-absolute bottom-0 start-0 ms-3 mb-3 fw-bold text-dark"><button class="btn btn-light btn-lg">Authors</h2></button></a></div>
		</div>
	</div>

@endsection