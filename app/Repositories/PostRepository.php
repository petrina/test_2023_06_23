<?php

namespace App\Repositories;

use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterfaces;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class PostRepository implements PostRepositoryInterfaces
{
    public function getAll(): AnonymousResourceCollection
    {
        try {
            $posts = Post::paginate(10);
            return PostResource::collection($posts);
        } catch (\Exception $e) {

            return response()->json(['message' => 'Error'], 500);
        }
    }

    public function show($post): PostResource
    {
        try {
            return new PostResource($post);
        } catch (\Exception $e) {

            return response()->json(['message' => 'Error show'], 500);
        }
    }

    public function delete($post): RedirectResponse
    {
        try {
            DB::table('post_tags')->where('post_id', $post->id)->delete();
            $post->translations()->delete();
            $post->delete();
            return redirect()->route('allPosts');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Error delete');
        }
    }

}

