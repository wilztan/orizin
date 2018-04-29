<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Genre;
use Validator;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Genre::orderBy('genre', 'asc')->get();
        return view('admin.genre.showgenre')->with('genre',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.genre.addgenre')->with('action','post');
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
            'genre' =>'required|min:3',
        ]);
        if ($validator->fails()) {
            return Redirect()->action('GenreController@create')
                ->withErrors($validator)->withInput();
        }
        Genre::create($request->all());
        return Redirect()->action('GenreController@index')->with('genre','Genre Created');
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
        $genre = Genre::find($id);
        return view('admin.genre.addgenre')->with('genre',$genre)->with('action','edit');
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
            'genre' =>'required|min:3',
        ]);
        
        if ($validator->fails()) {
            return Redirect()->action('GenreController@edit',$data->id)
                ->withErrors($validator)->withInput();
        }

        Genre::find($id)->update($request->all());
        return Redirect()->action('GenreController@index')->with('genre','Genre Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Genre::destroy($id);
        return Redirect()->action('GenreController@index')->with('genre','Genre Deleted');
    }
}
