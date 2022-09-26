<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
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

    // Function to get a user by Id
    public function show($id) 
    {
        try{

            $user = $this->user->findOrfail($id);
            
            return response()->json([
                'data' => [
                    'msg' => $user
                ]
                ], 200);

        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json([$message->getMessage(), 401]);
        }
    }  

    // Function to get a index of users
    public function index() 
    {
        
        try {
            // paginate 10 users
            $user = $this->user->paginate('10');

            return response()->json($user, 200);
            
        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json([$message->getMessage(), 401]);
        }

    }   

    // Function to register a new user
    public function store(UserRequest $request) 
    {

        $data = $request->all();
        
        try{    
            // hash password
            $data['password'] = bcrypt($data['password']);
            $user = $this->user->create($data);
            
            $token = $user->createToken($data['email']);
            

            return response()->json(['token' => $token->plainTextToken], 201);

        } catch (\Exception $e) {
            
            $message = new ApiMessages($e->getMessage());
            return response()->json([$message->getMessage(), 401]);
        }
    }   

    // Function to update a user by id
    public function update(UserRequest $request, $id)
    {
        $data = $request->all();
        try {
            $user = $this->user->findOrFail($id)->first();
            $user->update($data);

            return response()->json([
                'data' => [
                    'msg' => 'User updated!'
                ]
            ]);
        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json([$message->getMessage(), 401]);
        }
    }

    // Function to delete a user by id
    public function destroy($id) 
    {
        try{

            $user = $this->user->findOrFail($id)->first();
            $user->delete();

            return response()->json([
                'data' => [
                    'msg' => 'User removed!'
                ]
                ], 200);

        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json([$message->getMessage(), 401]);
        }
    }   

    // Function to Login a user
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
            $message = new ApiMessages($e->getMessage());
            return response()->json([$message->getMessage(), 401]);
        }
    }   
}
