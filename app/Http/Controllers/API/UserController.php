<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;
class UserController extends Controller
{
    public function userLogin(Request $request)
    {
       $input = $request->all();
      
       $validation = Validator::make($input,[
          'email' => 'required',
          'password'=> 'required'
       ]);
       if($validation->fails()){
        return response()->json(['errors'=>$validation->errors()->all()],422);
       }
      
       if(Auth::attempt(['email'=>$input['email'],'password'=>$input['password']]))
       {
       
        $user = Auth::user();
        $token = $user->createToken('MyApp')->accessToken;
        return response()->json(['token'=>$token]);
       }
    }
}
