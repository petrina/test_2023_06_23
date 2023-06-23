<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Language;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Post::factory(10)->create();
        $locales = [
            ['locale' => 'ukraine', 'prefix' => 'ua'],
            ['locale' => 'russia', 'prefix' => 'ru'],
            ['locale' => 'england', 'prefix' => 'en']
        ];

        foreach ($locales as $locale) {
            Language::create($locale);
        }
        \App\Models\PostTranslation::factory(30)->create();
        \App\Models\Tag::factory(10)->create();

    }
}
