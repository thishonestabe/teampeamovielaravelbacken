<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function login(Request $request) {
        
        $login = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
        // echo $login;
        if( !Auth::attempt($login) ) {
            return response(['message' => 'Invalid Credentials']);
        }

        $accessToken = Auth::user()->createToken('authtoken')->accessToken;

        return response(['user' => Auth::user(), 'access_token' => $accessToken]);
    }

    public function register(Request $request) {
        $user = DB::table('users')->insert([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);

        $login = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
        // echo $login;
        if( !Auth::attempt($login) ) {
            return response(['message' => 'Invalid Credentials']);
        }

        $accessToken = Auth::user()->createToken('authtoken')->accessToken;
        return response(['user' => Auth::user(), 'access_token' => $accessToken]);
       
    }

    public function logout(Request $request) {
        if (Auth::check()) {
            Auth::user()->AauthAcessToken()->delete();
         }
        return response(['message' => 'succesfully loged out']);
    }
}
