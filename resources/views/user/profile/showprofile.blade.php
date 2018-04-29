@extends('layouts.app')

@section('content')

<div class="container space">
    <div class="panel panel-default">
        <div class="panel-heading">Profile Manager</div>
        <div class="panel-body">
        	<div class="row">
        		<div class="col-md-4">
        			<img class="img-profile" src="{{asset('img/users').'/'.Auth::user()->id.'.'.Auth::user()->picture}}">
        			<div class="space"></div>
        		</div>
        		<div class="col-md-8">
        			<div class="well">
        				<div>Name <legend>{{Auth::user()->name}}</legend></div>
        				<div>email <legend>{{Auth::user()->email}}</legend></div>
        				<div>date of birth <legend>{{Auth::user()->dob}}</legend></div>
        				<div>Password <legend>Secret</legend></div>
        				<a href="{{action('ProfileController@edit',Auth::user()->id)}}" type="button" class="btn btn-default">Edit</a>
        			</div>
        		</div>
        	</div>
        </div>
    </div>
</div>

<div class="space"></div>
@endsection