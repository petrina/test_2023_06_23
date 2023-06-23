<?php

namespace App\Repositories\Interfaces;

interface PostTranslationRepositoryInterface
{
    public function create(array $data);
    public function getPostTranslation(int $post_id, int $language_id);
    public function update(int $post_id, int $language_id, array $data);
}
