@extends('layouts.app')

@section('content')

<div class="container space">
    <div class="panel panel-default">
        <div class="panel-heading">Games Manager</div>
        <div class="panel-body">
        	@if($action=="edit")
        		<form action="{{action('GameController@update',$games->id)}}" method="POST" role="form" enctype="multipart/form-data">
        		<input type="hidden" name="_method" value="PUT">
        	@else
        		<form action="{{action('GameController@store')}}" method="POST" role="form" enctype="multipart/form-data">
        	@endif
                {{ csrf_field() }}
        		<legend>Add New Games</legend>
        	
        		<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        			<label for="">Game Name</label>
        			<input type="text" class="form-control" id="" 
        			name="name" placeholder="Input Games" value="{{($action=='post')?old('name'):$games->name}}">
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
        		</div>


                <div class="form-group{{ $errors->has('genre_id') ? ' has-error' : '' }}">
                    <label for="">genre</label>
                    <select class="form-control" id="sel1" name="genre_id">
                        @if($action=='post')
                        <option disabled="" selected="">Input Genre</option>
                        @else
                        <option value="{{$games->genre_id}}" selected="">{{App\Genre::find($games->genre_id)->genre}}</option>
                        @endif
                        @foreach($genre as $data)
                        <option value="{{$data->id}}">{{$data->genre}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('genre_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('genre_id') }}</strong>
                        </span>
                    @endif
                </div>


                <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                    <label for="">Price <small>in Rupiah</small></label>
                    <input type="number" class="form-control" id="" 
                    name="price" placeholder="Input Price"  value="{{($action=='post')?old('price'):$games->price}}">
                    @if ($errors->has('price'))
                        <span class="help-block">
                            <strong>{{ $errors->first('price') }}</strong>
                        </span>
                    @endif
                </div>


                <div class="form-group{{ $errors->has('release') ? ' has-error' : '' }}">
                    <label for="">Release Date</label>
                    <input type="date" class="form-control" id="" 
                    name="release" placeholder="Input Release Date" value="{{($action=='post')?old('release'):$games->release}}">
                    @if ($errors->has('release'))
                        <span class="help-block">
                            <strong>{{ $errors->first('release') }}</strong>
                        </span>
                    @endif
                </div>


                <div class="form-group{{ $errors->has('picture') ? ' has-error' : '' }}">
                    <label for="">Game Image</label>
                    <input type="file" class="form-control" id="" 
                    name="picture" placeholder="Game Imange">
                    @if ($errors->has('picture'))
                        <span class="help-block">
                            <strong>{{ $errors->first('picture') }} and The Project Told me to make the image Required</strong>
                        </span>
                    @endif
                </div>
        	
        		<button type="submit" class="btn btn-primary">Submit Game</button>
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