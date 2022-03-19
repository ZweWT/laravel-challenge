<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostCollection;
use App\Http\Requests\PostLikeRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class PostController extends Controller
{
    public function list()
    { 
        $data = collect();

        $posts = Post::select(['id', 'title', 'description', 'created_at'])
                        ->with('tags', 'likes')->get()->each(function ($post){
            $data->add([
                'id'          => $post->id,
                'title'       => $post->title,
                'description' => $post->description,
                'tags'        => $post->tags,
                'like_counts' => $post->likes->count(),
                'created_at'  => $post->created_at,
            ]);
        });

        return new PostCollection($data);
    }
    
    public function toggleReaction(PostLikeRequest $request)
    {      
        try{
            $post = Post::findOrfail($request->post_id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Model not found'
            ],404);
        }
        
        if($post->user_id == auth()->id()) {
            return response()->json([
                'message' => 'You cannot like your post'
            ], 500);
        }
        
        $like = Like::where('post_id', $request->post_id)->where('user_id', auth()->id())->first();

        if($like && $like->post_id == $request->post_id && $request->like) {
            return response()->json([
                'message' => 'You already liked this post'
            ], 500);
        }elseif($like && $like->post_id == $request->post_id && !$request->like) {
            $like->delete();
            
            return response()->json([
                'message' => 'You unlike this post successfully'
            ], 200);
        }
        
        Like::create([
            'post_id' => $request->post_id,
            'user_id' => auth()->id()
        ]);
        
        return response()->json([
            'message' => 'You like this post successfully'
        ], 200);
    }
}
