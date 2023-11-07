@extends('layouts.app')

@section('content')
	<div class="container">
	<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Title</th>
      <th scope="col">Author</th>
      <th scope="col">Limit date</th>
      <th scope="col" colspan="2">Ações</th>
    </tr>
  </thead>
  <tbody>
@foreach($reserves as $reserve)
	<tr>
    <td>{{ $reserve->title }}</td>
    <td>{{$reserve->author->name }}</td>
    <td>{{$reserve->author->name }}</td>
    <td><form action='' method="POST">
        @csrf
        @method('DELETE')
        <button onclick="return confirm('Quer mesmo apagar este livro?')" class="btn btn-danger btn-sm" type="submit">Apagar</button>
      </td></form>
    </tr>
@endforeach
  </tbody>
</table>
</div>

@endsection