<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
       // Apply the jwt.auth middleware to all methods in this controller
       // We don't want to preventthe user from retrieving their token
       // if they don't already have it
       $this->middleware('jwt.auth');
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get All User
        $users = User::all();

        return response()->json([
          'users'=> $users
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        //Create user
        $user = new User($req->all());
        $user->save();

        return response()->json([
          'user'=> $user
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Get User(:id)
        $user = User::findOrFail($id);

        return response()->json([
          'user'=>$user
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        //Edit User(:id)
        $user = User::findOrFail($id);
        $user->name = $req->name;
        $user->email = $req->email;
        $user->save();

        return response()->json([
          'user'=>$user
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Delete User(:id)
        $user = User::findOrFail($id);
        $user->delete();
        //User::destroy($id);

        return response()->json([
          'user'=>$user
        ],200);
    }
}
