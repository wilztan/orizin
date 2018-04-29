<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Genre;
use App\Game;
use Auth;

class GuestController extends Controller
{
	function __construct()
	{
		$this->genre = Genre::orderBy('genre', 'asc')->get();
		$this->game = Game::orderBy('name', 'asc');
	}

	public function Index()
	{
		return view('welcome')
			->with('genre',$this->genre)
			->with('games',$this->game->paginate(6));
	}

    public function storeIndex()
    {
    	$game = Game::orderBy('name', 'asc')->paginate(6);
    	return view('store')
    		->with('genre',$this->genre)
    		->with('games',$game);
    }

    public function storeGenre($genre,$id)
    {
    	$game = Game::where('genre_id','=',$id)->paginate(6);
    	return view('store')
    		->with('genre',$this->genre)
    		->with('games',$game);
    }

    public function searchIndex(Request $request)
    {
    	$game = Game::where('name','LIKE','%'.$request->search.'%')->paginate(6);
    	return view('store')
    		->with('genre',$this->genre)
    		->with('games',$game);
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect()->action('GuestController@index');
        }
    }
}
