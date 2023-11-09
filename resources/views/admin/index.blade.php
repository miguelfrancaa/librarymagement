@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row" style="height: 80vh;">
			<div class="col-md-6 card h-50 mb-3"><a href="{{route('admin.books.index')}}">Books</a></div>
			<div class="col-md-6 card h-50 mb-3">Users</div>
			<div class="col-md-6 card h-50 mb-3">Reserves</div>
			<div class="col-md-6 card h-50 mb-3">Historic</div>
		</div>
	</div>

@endsection