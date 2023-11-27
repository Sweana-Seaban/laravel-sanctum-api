<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//added code
use App\Models\User;
use Illuminate\Http\Response; //create a custom response
use Illuminate\Support\Facades\Hash; //to hash passwords
//added code

class AuthController extends Controller
{
    //added code
    public function register(Request $request){
         //get the body frpm reposnse and validate it
         $fields = $request->validate([
            'name'=>'required|string',
            'email'=>'required|string|unique:users,email',
            'password'=>'required|string|confirmed'
         ]);

         $user =User::create([
            'name'=>$fields['name'],
            'email'=>$fields['email'],
            'password'=>bcrypt($fields['password'])
         ]);

        //create token 
        $token = $user->createToken('myapptoken')->plainTextToken;

        //pass user information 
        $response=[
            'user'=>$user,
            'token'=>$token
        ];

        return response($response,201);
    }

    public function login(Request $request){
        //get the body frpm reposnse and validate it
        $fields = $request->validate([
           'email'=>'required|string',
           'password'=>'required|string'
        ]);

        //check email
        $user = User::where('email',$fields['email'])->first();
        
        //check password
        if(!$user || !Hash::check($fields['password'],$user->password)){
            return response([
                'message'=>'invalid credentials'
            ],401);
        }

       //create token 
       $token = $user->createToken('myapptoken')->plainTextToken;

       //pass user information 
       $response=[
           'user'=>$user,
           'token'=>$token
       ];

       return response($response,201);
   }





    public function logout(Request $request){
        auth()->user()->tokens()->delete();

        return [
            'message'=>'Logged out'
        ];
    }

    //added code
}
