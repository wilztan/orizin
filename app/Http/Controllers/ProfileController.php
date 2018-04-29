<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Validator;
use Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.profile.showprofile');
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
        //
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
        $data = User::find($id);
        return view('user.profile.editprofile')->with('data',$data)->with('action','edit');
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
        if($request->email == Auth::User()->email){
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255|min:5',
                'dob' => 'required|before:-12 years',
                'picture' => 'required| mimes:jpeg,jpg,png',
            ]);
        }
        else{
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255|min:5',
                'email' => 'required|email|max:255|unique:users',
                'dob' => 'required|before:-12 years',
                'picture' => 'required| mimes:jpeg,jpg,png',
            ]);
        }

        if ($validator->fails()) {
            return Redirect()->action('ProfileController@edit',$id)
                ->withErrors($validator)->withInput();
        }

        $ext = $request->picture->getClientOriginalExtension();
        User::find($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'dob' => $request->dob,
            'picture' => $ext,
        ]);
        $request->file('picture')->move('img/users/', $id.'.'.$ext);

        return Redirect()->action('ProfileController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
