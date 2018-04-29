@extends('layouts.app')
{{$price=0}}
@section('content')

<div class="container space">
    <div class="row">

        {{-- Item List --}}
        <div class=" sidestore">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$data->name}}</div>

                    <div class="panel-body">
                        <div class="col-md-4">
                            <img src="{{asset('img/games').'/'.$data->id.'.'.$data->picture}}" alt="Avatar" style="width:100%">
                        </div>

                        <div class="col-md-">
                            <h4><b>{{$data->name}}</b></h4> 
                            <p>Rp. {{$data->price}}</p> 
                            <p>Release date : {{$data->release}}</p>
                            <p>Genre : {{App\Genre::where('id','=',$data->genre_id)->first()->genre}}</p>
                            <p>Rating : {{$rating}}</p>

                            <form action="{{action('CartController@store')}}" method="POST" role="form">
                                {{ csrf_field() }}
                                <input type="hidden" name="item_id" value="{{$data->id}}">
                                <button type="submit" class="btn btn-primary">Add to Cart</button>
                            </form>

                            <a class="btn btn-warning" data-toggle="modal" href='#modal-id'>Rate</a>
                            <div class="modal fade" id="modal-id">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">Rate {{$data->name}}</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{action('RateController@store')}}" method="POST" role="form">
                                                {{csrf_field()}}
                                                <input type="hidden" name="item_id" value="{{$data->id}}">
                                                <div class="form-group">
                                                    <label for="">Rate</label>
                                                    <select name="rate" id="input" class="form-control" required="">
                                                        <option value="1">1 Stars</option>
                                                        <option value="2">2 Stars</option>
                                                        <option value="3">3 Stars</option>
                                                        <option value="4">4 Stars</option>
                                                        <option value="5">5 Stars</option>
                                                    </select>
                                                </div>

                                            
                                                
                                            
                                                <button type="submit" class="btn btn-warning">Submit</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        {{-- Item List --}}

    </div>
</div>



@endsection
