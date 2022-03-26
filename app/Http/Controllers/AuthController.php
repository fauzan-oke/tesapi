<?php

namespace App\Http\Controllers;


use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function register(Request $request)
    {
      $validated = $this->validate($request,[
        'username' => 'required|max:255|unique:user,username',
        'password' => 'required',
        'user_level' => 'required'
      ]);
      $user = new User();
      $user->username = $validated['username'];
      $user->password = Hash::make($validated['password']);
      $user->user_level = $validated['user_level'];
      $user->save();
      return response()->json(['error' => 'false', 'success' => 'true'],201);
//      return response()->json($user, 201);


    }

    public function login(Request $request)
    {
      $validated = $this->validate($request,[
      'username' => 'required|exists:user,username',
      'password' => 'required'
    ]);

    $user= User::where('username', $validated['username'])->first();
    if (!Hash::check($validated['password'], $user->password)) {
      return abort(401, "username or password not valid");
    }

    $payload = [
      'iat' => intval(microtime(true)),
      'exp' => intval(microtime(true)) * (60 * 60 * 1000),
      'uid' => $user->id
    ];

    $token = JWT::encode($payload, env('JWT_SECRET'),'HS256');
    $user= User::where('username', $validated['username'])->first();
        if (empty($user)) {
            abort(404, "Data not found");
          }
    $user->token = $token;
    $user->save();
    return response()->json(['error'=>'false','data'=>
    ['user_id'=>$user->id,'username'=>$user->username,'access_token'=>$token]]);






    //
}}
