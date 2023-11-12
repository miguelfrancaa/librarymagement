@extends('layouts.app') 

@section('content')
	<div class="container">
		<div class="row mt-5 mb-5">
    	<form class="col-md-6" action="{{ route('admin.reserves.index') }}" method="get">
        <div class="input-group">
    	    <input name="search" type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon"/>
          <button type="submit" class="btn btn-outline-primary">search</button><br>
        </div>
    	</form>
    	@if($search)
    	    <div class="col-md-12">
    	        <h6 class="searching">You are searching for '{{ $search }}'</h6>
    	    </div>  
    	@endif
	</div>
  <div class="row">
    <div class="col-md-12 mb-5"><button class="btn btn-primary me-3 filter-button" data-filter='all'>All</button><button class="btn btn-outline-primary me-3 filter-button" data-filter='black'>Reserved</button><button class="btn btn-outline-primary filter-button" data-filter='grey'>Limit date passed</button><a href="{{ route('admin.delete.reserves') }}"><button  onclick="return confirm('Do you really want to delete all records?')" class="btn btn-outline-primary float-end">Delete all reserves with limit date passed</button></a></div>
  </div>
  <div class="row">
	<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#ID</th>
      <th scope="col">User</th>
      <th scope="col">Book</th>
      <th scope="col">Limit Date</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
@foreach($reserves as $reserve)
  @php
    $classColor = 'black';

    if(date("d-m-Y") > $reserve->created_at->addDays(3)->format('d-m-Y')) {
        $classColor = 'grey';
    }
  @endphp
	<tr class="filter {{$classColor}}">
      <th scope="row" style="color:{{$classColor}}">{{ $reserve->id }}</th>
      <td style="color:{{$classColor}}">{{ $reserve->user->firstname }} {{ $reserve->user->lastname }}</td>
      <td style="color:{{$classColor}}">{{ $reserve->book->author->name }} - {{ $reserve->book->title }}</td>
      <td style="color:{{$classColor}}">{{ $reserve->created_at->addDays(3)->format('d-m-Y') }}</td>
     <td><form action="{{ route('admin.destroy.reserve', [$reserve]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button onclick="return confirm('Quer mesmo apagar este livro?')" class="btn btn-danger btn-sm" type="submit">Delete</button></form>
      </td>
    </tr>
@endforeach
  </tbody>
</table>
</div>
@if(count($reserves) == 0)
        <h3 class="mt-2">No results for your search.</h3>
@endif
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('.filter-button').click(function() {

      $('.filter-button').removeClass('active btn-primary').addClass('btn-outline-primary');


      $(this).addClass('active btn-primary').removeClass('btn-outline-primary');

      var value = $(this).attr('data-filter');

      if (value == 'all') {
        $('.filter').show('1000');
      } else {
        $('.filter').not('.' + value).hide('3000');
        $('.filter').filter('.' + value).show('3000');
      }
    });
  });
</script>
@endsection