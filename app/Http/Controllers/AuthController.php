<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $fields = $request->validate([
            'user_id' => 'required|string',
            'display_name' => 'required|string',
            'first_name' =>'required|string',
            'last_name' =>'required|string',
            'email'=>'required|string|email|unique:users,email',
            'password' =>'required|confirmed',
            'phone_no' => 'required|string',
            'photo_url' => 'required|string',
            'seller_id' => 'required|string'
        ]);

        $user = User::create([
            'user_id'=>$fields['user_id'],
            'display_name'=>$fields['display_name'],
            'first_name'=>$fields['first_name'],
            'last_name'=>$fields['last_name'],
            'email'=>$fields['email'],
            'password'=>Hash::make($fields['password']),
            'phone_no'=>$fields['phone_no'],
            'photo_url'=>$fields['photo_url'],
            'seller_id'=>$fields['seller_id'],
        ]);

        //create token
        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'status'=>true,
            'message'=>'registered successfully!',
            'data' =>[
                'user'=>$user,
                'token'=>$token
            ]
        ];
        return response($response,201);
    }

    public function login(Request $request){
        $fields = $request->validate([
            'email'=>'required|string|email',
            'password' =>'required|confirmed'
        ]);
        //check email
        $user = User::where('email',$fields['email'])->first();
        //check password
        if(!$user || !Hash::check($fields['password'],$user->password)){
            return response(['status'=>false,'message'=>'invalid email or password'],401);
        }

        //create token
        $token = $user->createToken('remember_token')->plainTextToken;

        $response = [
            'status'=>true,
            'message'=>'Login successful!',
            'data' =>[
                'user'=>$user,
                'token'=>$token
            ]
        ];
        return response($response,201);
    }

    public function admin_login(Request $request){
        $fields = $request->validate([
            'email'=>'required|string|email',
            'password' =>'required|confirmed',
            'is_admin' =>'required|boolean'
        ]);
        //check email
        $user = User::where('email',$fields['email'])->first();
        //check password
        if(!$user || !Hash::check($fields['password'],$user->password)){
            return response(['status'=>false,'message'=>'invalid email or password'],401);
        }
        //check admin status
        if($fields['is_admin'] !== 1) {
            return response(['status'=>false, 'message'=>'You are not authorized to access this part of the site'],401);
        }

        //create token
        $token = $user->createToken('remember_token')->plainTextToken;

        $response = [
            'status'=>true,
            'message'=>'Login successful!',
            'data' =>[
                'user'=>$user,
                'token'=>$token
            ]
        ];
        return response($response,201);
    }
}
