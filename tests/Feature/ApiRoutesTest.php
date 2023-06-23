<?php

namespace Tests\Feature;

use App\Models\Language;
use App\Models\Post;
use App\Models\PostTranslation;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Database\Seeders\PostSeeder;
use Database\Seeders\TagSeeder;
use Database\Seeders\LanguageSeeder;
use Database\Seeders\PostTranslationSeeder;

class ApiRoutesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */


    public function testGetAllPosts()
    {
        $response = $this->get('/api/posts');
        $response->assertStatus(200);
    }

    public function testCreatePost()
    {
        $post = [
            'tags' => [
                'тег1',
                'тег2',
                'тег34',
                'тег1',
                'тег2',
                'йцйцйц',
            ],
            'data' => [
                [
                    'language_id' => 1,
                    'title' => 'Заголовок (RU)',
                    'description' => 'Описание (RU)',
                    'content' => 'Контент (RU)',
                ],
                [
                    'language_id' => 2,
                    'title' => 'Жора (EN)',
                    'description' => 'Описание (EN)',
                    'content' => 'Контент (EN)',
                ],
                [
                    'language_id' => 3,
                    'title' => 'Заголовок (UA)',
                    'description' => 'Описание (UA)',
                    'content' => 'Контент (UA)',
                ],
            ],
        ];

        $response = $this->post('/api/posts', $post);
        $response->assertStatus(302);
    }

    public function testShowPost()
    {
        // Создаем запись в таблице "posts"
        $post = Post::factory()->create();
        // Получаем идентификатор созданной записи
        $postId = $post->id;
        $response = $this->get("/api/posts/{$postId}");

        $response->assertStatus(200);
    }

    public function testShowPostTranslation()
    {
        // Создаем запись в таблице "posts"
        $post = Post::factory()->create();
        // Получаем идентификатор созданной записи
        $postId = $post->id;
        $language = New Language(); // replace with a language that exists

        $response = $this->get("/api/posts/{$postId}/{$language->id}");

        $response->assertStatus(200);
    }

    public function testUpdatePostTranslation()
    {
        // Создаем запись в таблице "posts"
        $post = Post::factory()->create();

        // Получаем идентификатор созданной записи
        $postId = $post->id;
        $language = 3; // replace with a language that exists
        $postTranslation = [
            'language_id' => 1,
            'title' => 'Контент (RU)',
            'description' => 'zxcxzcxz (RU)',
            'content' => 'Контент (RU)',
            ];


        $response = $this->put("/api/posts/{$postId}/{$language}", $postTranslation);

        $response->assertStatus(302);
    }

    public function testDeletePost()
    {
        // Создаем запись в таблице "posts"
        $post = Post::factory()->create();

        // Получаем идентификатор созданной записи
        $postId = $post->id;
        $response = $this->delete("/api/posts/{$postId}");

        $response->assertStatus(302);
    }

    public function testGetAllTags()
    {
        $response = $this->get('/api/tags');

        $response->assertStatus(200);
    }

    public function testCreateTag()
    {
        $tag = ['name' => 'Dedushka'];


        $response = $this->post('/api/tags', $tag);

        $response->assertStatus(302);
    }

    public function testShowTag()
    {
        // Создаем запись в таблице "posts"
        $tag = Tag::factory()->create();

        // Получаем идентификатор созданной записи
        $tagId = $tag->id;
        $response = $this->get("/api/tags/{$tagId}");

        $response->assertStatus(200);
    }


    public function testUpdateTag()
    {
        $tag = Tag::factory()->create();

        // Получаем идентификатор созданной записи
        $tagId = $tag->id;
        $tagTranslation = [
            'name'=>'babushka'
        ];
        $response = $this->put("/api/tags/{$tagId}", $tagTranslation);

        $response->assertStatus(200);
    }

    public function testDeleteTag()
    {
        $tag = Tag::factory()->create();

        // Получаем идентификатор созданной записи
        $tagId = $tag->id;
        $response = $this->delete("/api/tags/{$tagId}");

        $response->assertStatus(302);
    }
    public function testSearch()
    {

        $searchData = [
            'search' => "Deda"
        ];
        $response = $this->post('/api/search', $searchData);

        $response->assertStatus(200);
    }
}
