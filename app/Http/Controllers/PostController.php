<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\PostStoreRequest;
use App\Http\Requests\PostTranslation\PostTranslationRequest;
use App\Http\Resources\Post\PostResource;
use App\Http\Resources\Post\PostTranslationResource;
use App\Models\Post;
use App\Repositories\PostRepository;
use App\Repositories\PostTranslationRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PostController extends Controller
{
    private $postRepository;

    public function __construct(
        PostRepository $postRepository,
        PostTranslationRepository $postTranslationRepository
    )
    {
        $this->postRepository = $postRepository;
        $this->postTranslationRepository = $postTranslationRepository;
    }

    public function index(): AnonymousResourceCollection
    {
        return $this->postRepository->getAll();
    }

    public function store(PostStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        return $this->postTranslationRepository->create($data);
    }

    public function show(Post $post): PostResource
    {
        return $this->postRepository->show($post);
    }

    public function showPostTranslation(int $post_id, int $language_id): PostTranslationResource|JsonResponse
    {
        return $this->postTranslationRepository->getPostTranslation($post_id, $language_id);
    }
    public function updatePostTranslation(PostTranslationRequest $request, int $post_id, int $language_id): JsonResponse|RedirectResponse
    {
        $data = $request->validated();
        return $this->postTranslationRepository->update($post_id, $language_id, $data);
    }

    public function destroy(Post $post): RedirectResponse
    {
        return $this->postRepository->delete($post);
    }
}

