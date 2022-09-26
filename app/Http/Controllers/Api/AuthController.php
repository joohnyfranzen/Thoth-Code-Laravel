<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function show() 
    {

    }   
    public function index() 
    {
        
    }   
    public function store(UserRequest $request) 
    {

        $data = $request->all();

        if(!$request->has('password')){
            return response()->json(['Password Required', 401]);
        }
        if(!$request->has('name')){
            return response()->json(['Name Required', 401]);
        }
        if(!$request->has('email')){
            return response()->json(['Email Required', 401]);
        }

        try{

            $data['password'] = bcrypt($data['password']);
            $user = $this->user->create($data);
            
            $token = $user->createToken($data['email']);

            return response()->json(['token' => $token->plainTextToken], 200);

        } catch (\Exception $e) {
            return response()->json($e);
        }
    }   

    public function delete() 
    {
        
    }   
    public function login(AuthRequest $request) 
    {
        if(!$request->has('password')){  
            return response()->json(['Password Required', 401]);
        }
        if(!$request->has('email')){
            return response()->json(['Email Required', 401]);
        }

        $data = $request->all();
        
        try{

            $user = User::where('email', $data['email'])->first();

            if(!$user || !Hash::check($data['password'], $user->password)) {
                return response()->json('Incorrect Credentials');
            }
            $token = $user->createToken($data['email']);

            return response()->json(['token' => $token->plainTextToken], 200);

        } catch (\Exception $e) {
            return response()->json($e);
        }
    }   
}
