<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;

class PasswordController extends Controller
{
    public function __construct()
    {
        // Apply the jwt.auth middleware to all methods in this controller
        // We don't want to preventthe user from retrieving their token
        // if they don't already have it
        $this->middleware('jwt.auth');
    }

    /**
    * Reset Passwors
    *
    * @param  array  $req(password, new_password)
    * @return status
    */
    public function reset(Request $req){
        $credentials = $req->only('password','new_password');
        $user = JWTAuth::parseToken()->authenticate();

        if(password_verify($req->password, $user->password)){
            try{
                $user->password = $req->new_password;
                $user->save();
            }catch(Exceptions $e){
                return response()->json([$e],404);
            }
            return response()->json(['ok'], 200);
        }
        return response()->json(['error'], 202);
    }

}
