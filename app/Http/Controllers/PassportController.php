<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Validator;

class PassportController extends Controller
{
    // login
    public function login(Request $request){
        $login = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if(!Auth::attempt($login)){
            $msg = 'invalid credential!';
            return response()->json($msg);
        }

        $accessToken = Auth::user()->createToken('accessToken')->accessToken;

        return response()->json([
            'user' => Auth::user(),
            'access_token' => $accessToken,
        ]);
    }

    // register
    public function register(Request $request){
        $register = Validator::make($request->all(),
        [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);

        if($register->fails()){
            return response()->json($register->errors());
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $accessToken = $user->createToken('accessToken')->accessToken;

        return response()->json([
            'accessToken' => $accessToken
        ],200);
    }

    // get all user
    public function users(){
        $users = User::all();
        return response()->json($users);
    }
}
