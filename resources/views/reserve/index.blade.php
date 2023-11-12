@extends('layouts.app')

@section('content')
	<div class="container">
	<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Title</th>
      <th scope="col">Author</th>
      <th scope="col">Limit date</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody> 
@foreach($reserves as $reserve)
	<tr>
    <td><h4>{{ $reserve->title }}</h4></td>
    <td><h4>{{ $reserve->author->name }}</h4></td>
    <td><h4>{{ $reserve->pivot->created_at->addDays(3)->format('d-m-Y') }}</h4></td>
    <td><form action="{{ route('reserve.destroy', ['reserve' => $reserve->pivot->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button onclick="return confirm('Do you really want to delete the reserve?')" class="btn btn-danger btn-xl" type="submit">Remove reserve</button>
      </td></form>
    </tr>
@endforeach
  </tbody>
</table>
@if(count($reserves) == 0)
    <h3 class="mt-4">You don't have any reserved book yet. </h3>
@endif
</div>

@endsection