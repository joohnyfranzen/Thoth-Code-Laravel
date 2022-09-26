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

    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
