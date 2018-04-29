<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Game;
use App\Genre;
use Validator;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data =Game::orderBy('name', 'asc')->get();
        return view('admin.games.showgames')->with('games',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genre = Genre::all();
        return view('admin.games.managegames')->with('action','post')->with('genre',$genre);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' =>'required|min:3',
            'genre_id' =>'required',
            'release' => 'required|date',
            'price' => 'required|numeric|min:1',
            'picture'=> 'required| mimes:jpeg,jpg,png',
        ]);
        if ($validator->fails()) {
            return Redirect()->action('GameController@create')
                ->withErrors($validator)->withInput();
        }

        $ext = $request->file('picture')->getClientOriginalExtension();
        Game::create([
            'name' => $request->name,
            'genre_id' => $request->genre_id,
            'release' =>$request->release,
            'price' => $request->price,
            'picture' => $ext,
        ]);
        $game = Game::where('name','=',$request->name)->where('release','=',$request->release)->first();
        $request->file('picture')->move('img/games/', $game->id.'.'.$ext);
        return Redirect()->action('GameController@index')->with('genre','Genre Created');
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
        $genre = Genre::all();
        $games = Game::find($id);
        return view('admin.games.managegames')->with('action','edit')->with('genre',$genre)->with('games',$games);
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
        $validator = Validator::make($request->all(), [
            'name' =>'required|min:3',
            'genre_id' =>'required',
            'release' => 'required|date',
            'price' => 'required|numeric|min:1',
            'picture'=> 'required|mimes:jpeg,jpg,png',
        ]);
        if ($validator->fails()) {
            return Redirect()->action('GameController@edit',$id)
                ->withErrors($validator)->withInput();
        }
        if($request->picture==null){
            Game::find($id)->update([
                'name' => $request->name,
                'genre_id' => $request->genre_id,
                'release' =>$request->release,
                'price' => $request->price,
            ]);
        }else{
            $ext = $request->file('picture')->getClientOriginalExtension();
            Game::find($id)->update([
                'name' => $request->name,
                'genre_id' => $request->genre_id,
                'release' =>$request->release,
                'price' => $request->price,
                'picture' => $ext,
            ]);
            $request->file('picture')->move('img/games/', $id.'.'.$ext);
        }
        
        return Redirect()->action('GameController@index')->with('games','games updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Game::destroy($id);
        return redirect()->action('GameController@index');
    }
}
