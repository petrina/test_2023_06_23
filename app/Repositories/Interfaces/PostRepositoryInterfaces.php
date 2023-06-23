<?php

namespace App\Repositories\Interfaces;

use App\Models\Post;

interface PostRepositoryInterfaces
{
    public function getAll();
    public function show($post);
    public function delete($post);
}
