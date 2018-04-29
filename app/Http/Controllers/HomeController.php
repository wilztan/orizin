<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Game;
use App\Rate;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function viewProduct($id)
    {
        $rate = Rate::where('item_id','=',$id)->get();
        $count = $rate->count();
        $rating = 0;
        if($count!=0){
            foreach ($rate as $key => $data) {
                $rating= $rating+$data->rate;
            }
            $rating = $rating/$count;
        }
        return view('user.product.productshow')
        ->with('data',Game::where('id','=',$id)->first())
        ->with('rating',$rating);
    }
}
