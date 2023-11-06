@extends('layouts.app')

@section('content')
    
     <div class="container">
        <div class="row mt-3">
        	<h1 class="fw-bolder">Contact library</h1>
        	<h2 class="h4 mt-2">Here you can send directly messages to the library, asking for books, etc.</h2>
        </div>
        <form action="{{ route('contact.store') }}" method="POST">
        @csrf
        <div class="row">
        	<div class="col-md-12 mt-5">
        		 	<label for="subject" class="h3 fw-bolder text-md-end">{{ __('Subject') }}</label>
                    <input id="subject" type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" value="{{ old('subject') }}" required autocomplete="subject" autofocus>

                    @error('subject')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-12 mt-5">
        		 	<label for="message" class="h3 fw-bolder text-md-end">{{ __('Message') }}</label>
                    <textarea id="message" class="form-control @error('message') is-invalid @enderror" style="height: 30vh" name="message" required autocomplete="message" placeholder="Write your message to the library">{{ old('subject') }}</textarea>

                    @error('message')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    	{{ __('Send message') }}
                	</button>
            	</div>
        	</div>
        	@if (\Session::has('success'))
    			<div class="alert alert-success">
        			<ul>
            			<li>{!! \Session::get('success') !!}</li>
       			 </ul>
    			</div>
			@endif
        </form>
    </div>

@endsection