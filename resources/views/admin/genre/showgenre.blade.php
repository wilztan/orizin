@extends('layouts.app')

@section('content')

<div class="container space">
    <div class="panel panel-default">
        <div class="panel-heading">Genre Manager</div>
        <div class="panel-body">
        	<div>
        		<a type="button" class="btn btn-default" href="{{action('GenreController@create')}}">Add New Genre</a>
        	</div>
        	<br>
        	<table class="table table-bordered table-hover">
        		<thead>
        			<tr>
        				<th>Number</th>
        				<th>Genre</th>
        				<th>Option</th>
        			</tr>
        		</thead>
        		<tbody>
        			@foreach($genre as $key =>$data)
        			<tr>
        				<td>{{++$key}}</td>
        				<td>{{$data->genre}}</td>
        				<td><a href="{{action('GenreController@edit',$data->id)}}" type="button" class="btn btn-default">Edit</a>||<form action="{{action('GenreController@destroy',$data->id)}}" method="POST" role="form" style="display: inline"><input type="hidden" name="_method" value="DELETE">{{ csrf_field() }}
        					<button type="submit" class="btn btn-danger">Delete</button>
        					</form>
        				</td>
        			</tr>
        			@endforeach
        		</tbody>
        	</table>
        </div>
    </div>
</div>

@endsection