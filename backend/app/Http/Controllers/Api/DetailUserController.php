<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Exceptions\BadRequestException;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Exceptions\HttpResponseException;

use App\Models\User;

class DetailUserController extends Controller
{
    public function detail(int $id)
    {
        try{

            $user = User::selectById($id);

            return response()->json([
                'success' => true,
                'code' => 200,
                'data' => 
                        [
                            'name' => $user->name,
                            'email' => $user->email,
                        ]
            ],200);
        }catch(Exception $e){
            throw new HttpResponseException(response()->json([
                'success' => false,
                'code' => 500,
                'message' => "問題が発生しちゃったよ"//$e,
            ], 500));
        }

        $user = User::selectById($id);
        if (is_null($user)) {
            throw new BadRequestException();
        }
        return view('user.user_detail');
    }

}