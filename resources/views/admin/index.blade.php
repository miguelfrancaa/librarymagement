@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row" style="height: 80vh;">
			<div class="col-md-6 card h-50 mb-3"><a href="{{route('admin.books.index')}}"><h2 class="position-absolute bottom-0 start-0 ms-3 mb-3 fw-bold">Books</h2></a></div>
			<div class="col-md-6 card h-50 mb-3"><a href="{{ route('admin.users.index') }}"><h2 class="position-absolute bottom-0 start-0 ms-3 mb-3 fw-bold">Users</h2></a></div>
			<div class="col-md-6 card h-50 mb-3"><a><h2 class="position-absolute bottom-0 start-0 ms-3 mb-3 fw-bold">Reserves</h2></a></div>
			<div class="col-md-6 card h-50 mb-3"><a><h2 class="position-absolute bottom-0 start-0 ms-3 mb-3 fw-bold">Authors</h2></a></div>
		</div>
	</div>

@endsection