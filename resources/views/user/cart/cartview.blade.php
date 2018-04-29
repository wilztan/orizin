@extends('layouts.app')
{{$price=0}}
@section('content')

<div class="container space">
    <div class="row">
        <div class="col-md-8">
            {{-- Item List --}}
            <div class=" sidestore">
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">Welcome to Our Store</div>

                        <div class="panel-body">
                            @foreach($games as $data)
                            <div class=" col-md-4">
                                <div class="card">
                                    <img src="{{asset('img/games').'/'.$data->game_id.'.'.$data->picture}}" alt="Avatar" style="width:100%">

                                    <div class="container">
                                        <h4><b>{{str_limit($data->name, 14)}}</b></h4> 
                                        <br>
                                        <p>Quantity : 1</p>
                                        <p>Rp. {{$data->price}}</p> 
                                        <span style="display: none">{{$price = $price + $data->price}} 
                                            {{array_push($stack, $data->cart_id)}}
                                        </span>
                                        <form method="POST" role="form" action="{{action('CartController@destroy',$data->cart_id)}}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger">Remove from cart</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
            {{-- Item List --}}
        </div>


        <div class="col-md-4">
            <div class="row sidestore">
                <div class="panel panel-default">
                    <div class="panel-heading">Welcome to Our Store</div>

                    <div class="panel-body">
                        <legend>Total Price</legend>
                        <strong>{{$price}}</strong>
                        <form method="POST" role="form" action="{{action('CartController@update',0)}}">
                            <input type="hidden" name="_method" value="PUT">
                            {{ csrf_field() }}
                            @foreach($stack as $stack)
                                <input type="hidden" name="stack[]" value="{{$stack}}">
                            @endforeach
                            <button type="submit" class="btn btn-warning">Checkout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>



@endsection
