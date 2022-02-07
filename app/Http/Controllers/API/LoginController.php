<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends  Controller
{

    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index()
    {
        echo 'testing';
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);


        if (!auth()->attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid Credentials'
            ], 401);
        } else {
            $accessToken = $request->user()->createToken('access_token')->accessToken;
            return response([
                'user' => Auth::user(), 'access_token' => $accessToken
            ], 200);
        }
    }
}
