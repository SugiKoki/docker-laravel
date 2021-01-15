<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\KrononUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

const POPUP_FLAG_IMPUT_ERROR = 2;

class LoginController extends ApiController
{
    public function topPage()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email' => $email, 'password' => $password])) 
        {
            //藤本さん
            // $user = Auth::user();
            // $user->update(['api_token' => Str::random(60)]);

            $api_token = User::createApiToken($email);
            return response()->json([
                'success' => true,
                'code' => 200,
                'data' => $api_token,            
            ],200);
        } else {
            $popFlag = 2;
            return view('auth.login', ['email' => $email, 'popFlag' => $popFlag]);
        }
    }

}