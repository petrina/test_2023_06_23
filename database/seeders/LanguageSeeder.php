<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locales = [
            ['locale' => 'ukraine', 'prefix' => 'ua'],
            ['locale' => 'russia', 'prefix' => 'ru'],
            ['locale' => 'england', 'prefix' => 'en']
        ];

        foreach ($locales as $locale) {
            Language::create($locale);
        }
    }
}
