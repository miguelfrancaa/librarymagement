@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<img class="w-100" src="{{ $book->image }}">
		</div>
		<div class="col-md-6">
			<div class="mb-4">
				<h1 class="h2 mb-3 fw-bold">{{ $book->title }}</h1>
				<h2 class="h3 mb-3"><a class="authorName" href="{{ route('author.show', [$book->author_id]) }}">{{ $book->author->name }}</i>
</a></h2>
				<h3 class="h5">{{ $book->description }}</h3>
			</div>
			<div class="mb-4">
				@if(!empty($btn))
				<button class="btn btn-primary mb-4 btn-lg" type="button" id="favoriteBtn"><span>@if($btn === 'add')Add to favorites @else Remove favorite @endif </span><i class="bi bi-heart-fill"></i></button><br>
				@else
				<button class="btn btn-primary mb-4 btn-lg"><a href="{{ route('login') }}" style="text-decoration: none; color: white;">Add to favorite <i class="bi bi-heart-fill"></i></a></button>
				@endif
				<form action="{{ route('reserve.store') }}" method="POST">
					@csrf
					<input type="hidden" name="book_id" value="{{ $book->id }}">
					<button class="btn btn-primary btn-lg" type="submit"><span class="me-3">@if($reserveBtn === 'add')Reserve Book @else Delete Reserve @endif</span><i class="bi bi-arrow-right-square-fill"></i></button>
				</form>
			</div>
			<div class="mb-3"><a href="{{ route('category.show', [$book->category]) }}"><h5>See more from the category: {{ $book->category->name }}</h5></a></div>
			<h6 class="h5">{{ $book->quantity }} in stock.</h6>
			@if (\Session::has('success'))
    			<div class="alert alert-success">

            			{!! \Session::get('success') !!}

    			</div>
			@endif
			@if (\Session::has('removed'))
    			<div class="alert alert-danger">

            			{!! \Session::get('removed') !!}

    			</div>
			@endif
		</div>
	</div>
</div>
<script type="text/javascript">

	const favoriteBtn = document.getElementById('favoriteBtn');

favoriteBtn.addEventListener('click', () => {
    // Toggle the button text immediately
    const currentText = favoriteBtn.querySelector('span').textContent;
    favoriteBtn.querySelector('span').textContent = currentText === 'Add to favorites' ? 'Remove favorite' : 'Add to favorites';

    axios.post('/favorite/{{ $book->id }}').then(response => {
        if (response.data.attached.length) {
            favoriteBtn.querySelector('span').textContent = 'Remove favorite';
        } else {
            favoriteBtn.querySelector('span').textContent = 'Add to favorites';
        }
    });
});

</script>

@endsection