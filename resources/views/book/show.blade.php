@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<img class="w-100" src="{{ $book->image }}">
		</div>
		<div class="col-md-6">
			<div class="mb-5">
				<h1 class="h2 mb-3 fw-bold">{{ $book->title }}</h1>
				<h2 class="h3 mb-3"><a href="">{{ $book->author->name }}</i>
</a></h2>
				<h3 class="h5">{{ $book->description }}</h3>
			</div>
			<div class="mb-5">
				<button class="btn btn-primary mb-5"><span class="me-3">Adicionar aos favoritos</span><i class="bi bi-heart-fill"></i></button><br>
				<button class="btn btn-primary"><span class="me-3">Reservar livro</span><i class="bi bi-arrow-right-square-fill"></i></button>
			</div>
			<div><a href="{{ route('category.show', [$book->category]) }}"><h5>Ver mais da categoria: {{ $book->category->name }}</h5></a></div>
		</div>
	</div>
</div>

@endsection