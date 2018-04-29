<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Game;
use App\Cart;
use App\TransactionHistory;
use Auth;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Game::join('carts', 'games.id', '=', 'carts.item_id')
        ->having('user_id','=',Auth::User()->id)
        ->select('games.id as game_id','carts.id as cart_id','name','price','release','picture','user_id')
        ->get();
        return view('user.cart.cartview')->with('games',$games)->with('stack',array());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Cart::Create([
            'user_id'=>Auth::User()->id,
            'item_id'=>$request->item_id,
        ]);
        return redirect()->action('CartController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $stack = $request->stack;
        for ($a=0; $a < count($stack); $a++) { 
            $cart = Cart::find($stack[$a]);
            TransactionHistory::create([
                'user_id'=>Auth::User()->id,
                'item_id'=>$cart->item_id,
            ]);
            Cart::destroy($stack[$a]);
        }
        return redirect()->action('CartController@myGames');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::destroy($id);
        return redirect()->action('CartController@index');
    }

    public function myGames()
    {
        $games = Game::join('transaction_histories', 'games.id', '=', 'transaction_histories.item_id')->having('user_id','=',Auth::User()->id)->select('games.id as game_id','transaction_histories.id as cart_id','name','price','release','picture','user_id')->get();
        return view('user.cart.mygames')->with('games',$games);
    }
}
