<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tag\TagRequest;
use App\Http\Resources\Tag\TagResource;
use App\Models\Tag;
use App\Repositories\TagRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TagController extends Controller
{
    private $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function index(): AnonymousResourceCollection
    {
        return $this->tagRepository->getAll();
    }

    public function store(TagRequest $request): RedirectResponse
    {

        $data = $request->validated();
        return $this->tagRepository->create($data);
    }

    public function show(Tag $tag): TagResource
    {
        return $this->tagRepository->getById($tag);
    }

    public function update(TagRequest $request, Tag $tag): TagResource
    {
        $data = $request->validated();
        return $this->tagRepository->update($tag, $data);
    }

    public function destroy(Tag $tag): RedirectResponse
    {
        return $this->tagRepository->delete($tag);
    }
}

