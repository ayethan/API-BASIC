<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Resources\PostResource;
use App\Http\Requests\PostStore;
use App\Http\Requests\PostUpdate;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
    	return PostResource::collection(Post::paginate(2));

    }

    public function show(Post $post)
    {
        return new PostResource($post->with('user')->first());
    }

    public function store(PostStore $request)
    {
    	$post = new Post;
    	$post->title = $request->title;
    	$post->description = $request->description;
    	$post->user()->associate($request->user());
    	$post->save();
        
        return new PostResource($post);
    }

    public function update(Post $post, PostUpdate $request)
    {
        $this->authorize('update', $post);
        $post->update(['title' => $request->title]);
        return new PostResource($post);
    }

    public function destory(Post $post)
    {
        $this->authorize('destory', $post);
        $post->delete();
        return response(null, 204);
    }
}
