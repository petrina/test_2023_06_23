<?php

namespace App\Repositories;

use App\Http\Resources\Tag\TagResource;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class TagRepository
{
    public function getAll(): AnonymousResourceCollection
    {
        $tags = Tag::paginate(5);
        return TagResource::collection($tags);
    }

    public function getById($tag): TagResource
    {
        return new TagResource($tag);
    }

    public function create($data): RedirectResponse
    {
        Tag::create($data);
        return redirect()->route('allTags');
    }

    public function update($tag, $data): TagResource
    {
        $tag->update($data);
        return new TagResource($tag);
    }

    public function delete($tag): RedirectResponse
    {
        DB::table('post_tags')->where('tag_id', $tag->id)->delete();
        $tag->delete();
        return redirect()->route('allTags');
    }
}
