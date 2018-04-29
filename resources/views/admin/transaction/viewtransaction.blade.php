@extends('layouts.app')

@section('content')

<div class="container space">
    <div class="panel panel-default">
        <div class="panel-heading">TransactionHistory Manager</div>
        <div class="panel-body">
            <br>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Number</th>
                        <th>UserName</th>
                        <th>Transaction Date</th>
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaction as $key =>$data)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{App\User::where('id','=',$data->user_id)->first()->name}}</td>
                        <td>{{$data->created_at}}</td>
                        <td>{{-- <a href="{{action('TransactionHistoryController@edit',$data->id)}}" type="button" class="btn btn-default">Edit</a>|| --}}<form action="{{action('TransactionHistoryController@destroy',$data->id)}}" method="POST" role="form" style="display: inline"><input type="hidden" name="_method" value="DELETE">{{ csrf_field() }}
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