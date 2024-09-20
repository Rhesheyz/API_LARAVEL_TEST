<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PostDetailResource;

class PostController extends Controller
{
    public function index()
    {
        //lazyload
        $posts = Post::all();
        return PostDetailResource::collection($posts->loadMissing('writer:id,username'));  
    }

    public function Show($id)
    {
        //eagerload
        $post = Post::with('writer:id,username')->findOrFail($id);
        return new PostDetailResource($post);    
    }

    public function Show2($id)
    {
        $post = Post::findOrFail($id);
        return new PostDetailResource($post);    
    }

    public function store(request $request){
        $validated = $request->validate([
            'title' => 'required|max:255',
            'news_content' => 'required',
        ]);

        $request['author'] = Auth::user()->id;
        $post = Post::create($request->all());
        return new PostDetailResource($post->loadMissing('writer:id,username'));
    }

    public function update(request $request, $id){
        $validated = $request->validate([
            'title' => 'required|max:255',
            'news_content' => 'required',
        ]);

        $post = Post::findOrFail($id);
        $post->update($request->all());
        return new PostDetailResource($post->loadMissing('writer:id,username'));
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return new PostDetailResource($post->loadMissing('writer:id,username'));
    }
}
