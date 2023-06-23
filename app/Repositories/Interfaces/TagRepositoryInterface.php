<?php

namespace App\Repositories\Interfaces;

interface TagRepositoryInterface
{
    public function getAll();
    public function getById($tag);
    public function create($data);
    public function update($tag, $data);
    public function delete($id);



}
