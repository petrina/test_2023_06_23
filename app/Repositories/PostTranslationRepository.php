<?php

namespace App\Repositories;

use App\Http\Resources\Post\PostTranslationResource;
use App\Models\Post;
use App\Models\PostTranslation;
use App\Models\Tag;
use App\Repositories\Interfaces\PostTranslationRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class PostTranslationRepository implements PostTranslationRepositoryInterface
{
    public function create(array $data): RedirectResponse
    {
        try {
            DB::transaction(function() use ($data) {
                $post = new Post();
                $post->save();

                if (!empty($data['tags'])) {
                    foreach ($data['tags'] as $tagName) {
                        $tag = Tag::withTrashed()->where('name', $tagName)->first();

                        if ($tag && $tag->trashed()) {
                            $tag->restore();
                        } elseif (!$tag) {
                            $tag = Tag::create(['name' => $tagName]);
                        }

                        $tag->posts()->attach($post->id);
                    }
                }

                foreach ($data['data'] as $postTranslation) {
                    PostTranslation::create([
                        'post_id' => $post->id,
                        'language_id' => $postTranslation['language_id'],
                        'title' => $postTranslation['title'],
                        'description' => $postTranslation['description'],
                        'content' => $postTranslation['content'],
                    ]);
                }
            });

            return redirect()->route('allPosts');
        } catch (\Exception $e) {
            // Обработка ошибки
            // Например, возвращение сообщения об ошибке или логирование ошибки
            return redirect()->back()->with('error', 'Ошибка при создании поста');
        }
    }


    public function getPostTranslation($post_id, $language_id): PostTranslationResource|JsonResponse
    {
        $post = PostTranslation::firstWhere([
            'post_id' => $post_id,
            'language_id' => $language_id,
        ]);
        if(!empty($post)){
            return new PostTranslationResource($post);
        }else{
            return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
        }
    }

    public function update($post_id, $language_id, array $data): JsonResponse|RedirectResponse
    {
        $postTranslation = DB::table('post_translations')
            ->where('post_id', $post_id)
            ->where('language_id', $language_id);
        if(!empty($postTranslation)){
            $postTranslation->update($data);
            return redirect()->route('allPosts');
        }else{
            return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
        }

    }
}

