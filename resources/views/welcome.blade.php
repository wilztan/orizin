@extends('layouts.app')

@section('content')

{{-- Carousel --}}
<div>
    <div id="carousel-id" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carousel-id" data-slide-to="0" class=""></li>
            <li data-target="#carousel-id" data-slide-to="1" class=""></li>
            <li data-target="#carousel-id" data-slide-to="2" class="active"></li>
        </ol>
        <div class="carousel-inner">
            <div class="item">
                <img data-src="holder.js/900x500/auto/#777:#7a7a7a/text:First slide" alt="First slide" src="{{asset('img/slider/ffxv.jpg')}}">
                <div class="container">
                    <div class="carousel-caption">
                        <h1>Get The Latest Game in 20{{date("y")}}</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    </div>
                </div>
            </div>
            <div class="item">
                <img data-src="holder.js/900x500/auto/#666:#6a6a6a/text:Second slide" alt="Second slide" src="{{asset('img/slider/battlefield.jpg')}}">
                <div class="container">
                    <div class="carousel-caption">
                        <h1>Another example headline.</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    </div>
                </div>
            </div>
            <div class="item active">
                <img data-src="holder.js/900x500/auto/#555:#5a5a5a/text:Third slide" alt="Third slide" src="{{asset('img/slider/overwatch.jpg')}}">
                <div class="container">
                    <div class="carousel-caption">
                        <h1>Overwatch more for good measure.</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. </p>
                    </div>
                </div>
            </div>
        </div>
        <a class="left carousel-control" href="#carousel-id" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
        <a class="right carousel-control" href="#carousel-id" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div>
</div>

{{-- Item List --}}
<div class="container space">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">Welcome to Our Store</div>

            <div class="panel-body">
                @foreach($games as $data)
                    @php
                        $rate = App\Rate::where('item_id','=',$data->id)->get();
                        $count = $rate->count();
                        $rating = 0;
                        if($count!=0){
                            foreach ($rate as $datas) {
                                $rating= $rating+$datas->rate;
                            }
                            $rating = $rating/$count;
                        }
                    @endphp
                    <div class=" col-md-4">
                        <div class="card">
                            <img src="{{asset('img/games').'/'.$data->id.'.'.$data->picture}}" alt="Avatar" style="width:100%">
                            <div class="container">
                                <h4><b>{{str_limit($data->name, 20)}}</b></h4> 
                                <p>Rp. {{$data->price}}</p> 
                                <p>Rate : {{$rating}}</p>
                                @if(Auth::check())
                                    <a class="btn btn-info" href="{{action('HomeController@viewProduct',$data->id)}}">View Product</a>
                                    <br>
                                    <form action="{{action('CartController@store')}}" method="POST" role="form">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="item_id" value="{{$data->id}}">
                                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                <br>
                {{ $games->links() }}

            </div>
        </div>
    </div>
</div>
{{-- Item List --}}


@endsection
