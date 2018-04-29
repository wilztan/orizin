@extends('layouts.app')

@section('content')

<div class="container space">
    <div class="row">
        <div class="col-md-4">
            <div class="row sidestore">
                <div class="panel panel-default">
                    <div class="panel-heading">Welcome to Our Store</div>

                    <div class="panel-body">
                        <legend>Genres</legend>
                        <ul>
                            @foreach($genre as $genre)
                            <li><a href="{{action('GuestController@storeGenre',[$genre->genre,$genre->id])}}">{{$genre->genre}}</a></li>
                            @endforeach
                        </ul>
                        <form method="POST" role="form" action="{{action('GuestController@searchIndex')}}">
                            {{ csrf_field() }}
                            <legend>Find Your Game</legend>
                        
                            <div class="form-group">
                                <input type="text" class="form-control" id="" placeholder="Search Now" name="search">
                            </div>
                        
                            
                        
                            <button type="submit" class="btn btn-primary">Find</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            {{-- Item List --}}
            <div class=" sidestore">
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
                                        <h4><b>{{str_limit($data->name, 14)}}</b></h4> 
                                        <p>Rp. {{$data->price}}</p> 
                                        <p>Rate : {{$rating}}</p>
                                        @if(Auth::check())
                                            <a class="btn btn-info" href="{{action('HomeController@viewProduct',$data->id)}}">View Product</a>
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

                            <div class="space"><br></div><div class="space"></div>

                            
                            {{ $games->links() }}
                        </div>
                    </div>
                </div>
            </div>
            {{-- Item List --}}
        </div>
    </div>
</div>



@endsection
