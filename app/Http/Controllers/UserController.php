<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Auth;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::orderBy('name', 'asc')->get();
        return view('admin.users.showusers')->with('user',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.registernew');
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
            'name' => 'required|max:255|min:5',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:5|confirmed|alpha_num',
            'dob' => 'required|before:-12 years',
            'picture' => 'required| mimes:jpeg,jpg,png',
        ]);
        if ($validator->fails()) {
            return Redirect()->action('UserController@create')
                ->withErrors($validator)->withInput();
        }
        
        $ext = $request->file('picture')->getClientOriginalExtension();
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'dob' => $request->dob,
            'picture' => $ext,
        ]);
        $user = User::where('email','=',$request->email)->first();
        $request->file('picture')->move('img/users/', $user->id.'.'.$ext);
        return redirect()->action('UserController@index');
    
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
        return view('admin.users.manageusers')->with('data',$data)->with('action','edit');
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
                'password' => 'required|min:5|confirmed|alpha_num',
                'picture' => 'required| mimes:jpeg,jpg,png',
            ]);
        }
        else{
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255|min:5',
                'email' => 'required|email|max:255|unique:users',
                'dob' => 'required|before:-12 years',
                'password' => 'required|min:5|confirmed|alpha_num',
                'picture' => 'required| mimes:jpeg,jpg,png',
            ]);
        }

        if ($validator->fails()) {
            return Redirect()->action('UserController@edit',$id)
                ->withErrors($validator)->withInput();
        }

        $ext = $request->picture->getClientOriginalExtension();
        User::find($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'dob' => $request->dob,
            'picture' => $ext,
        ]);
        $request->file('picture')->move('img/users/', $id.'.'.$ext);

        return Redirect()->action('UserController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return Redirect()->action('UserController@index')->with('User','User Deleted');
    }
}
