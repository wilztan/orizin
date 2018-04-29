@extends('layouts.app')

@section('content')

<div class="container space">
    <div class="panel panel-default">
        <div class="panel-heading">User Manager</div>
        <div class="panel-body">
        	<div>
        		<a type="button" class="btn btn-default" href="{{action('UserController@create')}}">Register New User</a>
        	</div>
        	<br>
        	<table class="table table-bordered table-hover">
        		<thead>
        			<tr>
        				<th>Number</th>
        				<th>Name</th>
                        <th>Email</th>
                        <th>Birth Date</th>
                        <th>Picture</th>
        				<th>Option</th>
        			</tr>
        		</thead>
        		<tbody>
        			@foreach($user as $key =>$data)
        			<tr>
        				<td>{{++$key}}@if($data->role=="admin") <strong>admin</strong>@else <strong>user</strong>@endif</td>
        				<td>{{$data->name}}</td>
                        <td>{{$data->email}}</td>
                        <td>{{$data->dob}}</td>
                        <td><img class="img-nav" src="{{asset('img/users').'/'.$data->id.'.'.$data->picture}}"></td>
        				<td><a href="{{action('UserController@edit',$data->id)}}" type="button" class="btn btn-default">Edit</a>||<form action="{{action('UserController@destroy',$data->id)}}" method="POST" role="form" style="display: inline"><input type="hidden" name="_method" value="DELETE">{{ csrf_field() }}
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