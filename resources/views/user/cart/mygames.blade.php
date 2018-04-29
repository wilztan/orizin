@extends('layouts.app')
{{$price=0}}
@section('content')

<div class="container space">
    <div class="row">

        {{-- Item List --}}
        <div class=" sidestore">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Your Purchased Item</div>

                    <div class="panel-body">
                        @foreach($games as $data)
                            @php
                                $rate = App\Rate::where('item_id','=',$data->game_id)->get();
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
                                <img src="{{asset('img/games').'/'.$data->game_id.'.'.$data->picture}}" alt="Avatar" style="width:100%">

                                <div class="container">
                                    <h4><b>{{str_limit($data->name, 14)}}</b></h4> 
                                    <p>Rp. {{$data->price}}</p> 
                                    <p>Rate : {{$rating}}</p>
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
</div>



@endsection
