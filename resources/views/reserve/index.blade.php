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
    <td>{{ $reserve->title }}</td>
    <td>{{ $reserve->author->name }}</td>
    <td>{{ $reserve->pivot->created_at->addDays(3)->format('d-m-Y') }}</td>
    <td><form action="{{ route('reserve.destroy', ['reserve' => $reserve->pivot->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button onclick="return confirm('Do you really want to delete the reserve?')" class="btn btn-danger btn-sm" type="submit">Remove reserve</button>
      </td></form>
    </tr>
@endforeach
  </tbody>
</table>
</div>

@endsection