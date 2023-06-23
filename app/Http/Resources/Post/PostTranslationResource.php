<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostTranslationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'language' => $this->language->prefix,
            'title' => $this->title,
            'description' => $this->description,
            'content' => $this->content,
            'post_id' => $this->post_id,
            'language_id'=>$this->language_id
        ];
    }
}
