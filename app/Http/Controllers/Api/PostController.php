<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Constructor
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    // Index 10 posts
    public function index()
    {
        $posts = $this->post->paginate('10');

        return response()->json($posts, 200);
    }

    // Create a new post
    public function store(PostRequest $request)
    {
        $data = $request->all();
        
        try{

            $post = Auth::user()->post()->create($data);


            return response()->json($post);

        } catch (\Exception $e) {
            return response()->json($e);
        }
    }

    // Show a Post by Id
    public function show($id)
    {

        try {
            $user = $this->post->findOrFail($id);

            return response()->json([
                'data' => [
                    'msg' => $user
                ]
                ], 200);

            } catch (\Exception $e) {
                return response()->json($e);
            }
    }

    // Update a Post by Id
    public function update(PostRequest $request, $id)
    {
        $data = $request->all();

        try {

            $post = $this->post->findOrFail($id);
            $post->update($data);

            return response()->json([
                'data' => [
                    'msg' => $post
                ]
                ], 200);
 
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }

    // Delete a post bu Id
    public function destroy($id)
    {
        try {
            $post = $this->post->findOrFail($id);
            $post->delete();

            return response()->json([
                'data' => [
                    'msg' => 'Post Deleted'
                ]
                ], 200);

            } catch (\Exception $e) {
                return response()->json($e);
            }
    }

    public function userIndex() 
    {
        
        try {
            $user = Auth::user()->post->paginate('5');

            return response()->json([
                'data' => [
                    'msg' => $user
                ]
                ], 200);

            } catch (\Exception $e) {
                return response()->json($e);
            }
    }
}
