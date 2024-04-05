<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function create(Request $request){
        $rules=[
            'name'=>'required|string',
            'email'=>'required|unique:users,email',
            'password' => 'required|string|min:8'
            
        ];
        $request->validate($rules);
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=> Hash::make($request->password),
        ]);

        $token=$user->createToken('Personal access token')->accessToken;
        $response=['user'=>$user,'token'=>$token];
        return response()->json($response,200);

    }


    // public function login(Request $request){
    //     $credentials=[
    //         'email'=>$request->email,
    //         'password'=>$request->password
    //     ];
    //     if(!Auth::attempt($credentials)){
    //         return response()->json([
    //             'success'=>false,
    //             'messafe'=>'email or password',
    //             'user'=>null,
    //         ]);
    //     }
    //     $user=$request->user();
    //     $token=$user->createToken('Personal access token')->accessToken;
    //     return response()->json([
    //         'success'=>true,
    //         'message'=>'success',
    //         'user'=>Auth::user(),
    //         'token'=>$token
    //     ]);
    // }

    public function logout(Request $request)
    {
        $user = $request->user();

        if ($user) {
            $user->tokens->each(function ($token) {
                $token->revoke();
            });

            return response()->json(['message' => 'Logout successful'], 200);
        }

        return response()->json(['message' => 'User not authenticated'], 401);
    }



    // public function login(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');
    
    //     if (Auth::attempt($credentials)) {
    //         $user = Auth::user();
    //         $token = $user->createToken('authToken')->accessToken;
    
    //         return response()->json(['token' => $token,'user'=>$user], 200);
    //     } else {
    //         return response()->json(['error' => 'Unauthorized'], 401);
    //     }
    // }


    // public function login(Request $request)
    // {
    //     $credentials = $request->only('nom','motDPss');
    // ;
    //     // motDPss
    //     if (Auth::guard('utilisateur')->attempt($credentials)) {
            
    
    //         return response()->json(['token' => 'ok'], 200);
    //     } else {
    //         return response()->json(['error' => 'Unauthorized'], 401);
    //     }
    // }
  

    // public function login(Request $request){ 

    //     $credentials=[

    //         // 'email'=>$request->email
    //         'password'=>$request->password
    //         // 'name'=>$request->name
    //     ];
    //     if(Auth::attempt($credentials)){
    //         return response()->json([
    //             'message'=>'email ok',
    //         ]);
    //     }
    // }

}
