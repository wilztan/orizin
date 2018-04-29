@extends('layouts.app')

@section('content')

<div class="container space">
    <div class="panel panel-default">
        <div class="panel-heading">Genre Manager</div>
        <div class="panel-body">
        	@if($action=="edit")
        		<form action="{{action('GenreController@update',$genre->id)}}" method="POST" role="form">
        		<input type="hidden" name="_method" value="PUT">
        	@else
        		<form action="{{action('GenreController@store')}}" method="POST" role="form">
        	@endif
                {{ csrf_field() }}
        		<legend>Add New Genre</legend>
        	
        		<div class="form-group {{ $errors->has('genre') ? ' has-error' : '' }}">
        			<label for="">genre</label>
        			<input type="text" class="form-control" id="" 
        			
        			@if($action=="edit")
        				value="{{$genre->genre}}"
        			@endif 

        			name="genre" placeholder="Input GENRE">
                    @if ($errors->has('genre'))
                        <span class="help-block">
                            <strong>{{ $errors->first('genre') }}</strong>
                        </span>
                    @endif
        		</div>
        	
        		<button type="submit" class="btn btn-primary">Submit Genre</button>
        	</form>
        </div>
    </div>
</div>
<div class="space"></div>
<div class="space"></div>
<div class="space"></div>
<div class="space"></div>
<div class="space"></div>
<div class="space"></div>
<div class="space"></div>
@endsection