<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function show(Request $request) 
    {

    }   
    public function index() 
    {
        
    }   
    public function store(Request $request) 
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

        Validator::make($data, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ])->validate();

        try{

            $data['password'] = bcrypt($data['password']);
            $user = $this->user->create($data);
            return response()->json($user, 200);

        } catch (\Exception $e) {
            return response()->json($e);
        }
    }   

    public function delete() 
    {
        
    }   
    public function login(Request $request) 
    {
        if(!$request->has('password')){
            
            return response()->json(['Password Required', 401]);
        }
        if(!$request->has('email')){
            return response()->json(['Email Required', 401]);
        }

        $data = $request->all();
        
        Validator::make($data, [
            'email' => 'required',
            'password' => 'required'
        ])->validate();

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
