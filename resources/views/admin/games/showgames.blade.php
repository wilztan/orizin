@extends('layouts.app')

@section('content')

<div class="container space">
    <div class="panel panel-default">
        <div class="panel-heading">Games Manager</div>
        <div class="panel-body">
        	<div>
        		<a type="button" class="btn btn-default" href="{{action('GameController@create')}}">Add New Games</a>
        	</div>
        	<br>
        	<table class="table table-bordered table-hover">
        		<thead>
        			<tr>
        				<th>Number</th>
        				<th>Games</th>
                        <th>Genre</th>
                        <th>Price</th>
                        <th>Release</th>
                        <th>Picture</th>
        				<th>Option</th>
        			</tr>
        		</thead>
        		<tbody>
        			@foreach($games as $key =>$data)
        			<tr>
        				<td>{{++$key}}</td>
        				<td>{{$data->name}}</td>
                        <td>{{App\Genre::find($data->genre_id)->genre}}</td>
                        <td>{{$data->price}}</td>
                        <td>{{$data->release}}</td>
                        <td><img class="img-nav" src="{{asset('img/games').'/'.$data->id.'.'.$data->picture}}"></td>
        				<td><a href="{{action('GameController@edit',$data->id)}}" type="button" class="btn btn-default">Edit</a>||<form action="{{action('GameController@destroy',$data->id)}}" method="POST" role="form" style="display: inline"><input type="hidden" name="_method" value="DELETE">{{ csrf_field() }}
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