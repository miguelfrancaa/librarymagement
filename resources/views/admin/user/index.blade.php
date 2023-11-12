@extends('layouts.app') 

@section('content')
	<div class="container">
		<div class="row mt-5 mb-5">
    	<form class="col-md-6" action="{{ route('admin.users.index') }}" method="get">
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
    <div class="col-md-12 mb-5"><button class="btn btn-primary me-3 filter-button" data-filter='all'>All</button><button class="btn btn-outline-primary me-3 filter-button" data-filter='users'>Users</button><button class="btn btn-outline-primary filter-button" data-filter='admins'>Admins</button></div>
  </div>
  <div class="row">
	<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#ID</th>
      <th scope="col">Name</th>
      <th scope="col">Author</th>
      <th scope="col" colspan="2">Actions</th>
    </tr>
  </thead>
  <tbody>
@foreach($users as $user)
  @php
       // Default role class
       $roleClass = 'users';

       // Change role class based on user role
       if($user->role == 1) {
           $roleClass = 'admins';
       }
   @endphp
	<tr class="filter {{ $roleClass }}">
      <th scope="row">{{ $user->id }}</th>
      <td>{{ $user->firstname }} {{ $user->lastname }}</td>
      <td>{{ $user->name }}</td>
     <td><form action='' method="POST">
        @csrf
        <button class="btn btn-warning btn-sm" type="submit">Editar</button></form>
      </td>
     <td><form action='' method="POST">
        @csrf
        @method('DELETE')
        <button onclick="return confirm('Quer mesmo apagar este livro?')" class="btn btn-danger btn-sm" type="submit">Apagar</button></form>
      </td>
    </tr>
@endforeach
  </tbody>
</table>
</div>
@if(count($users) == 0)
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