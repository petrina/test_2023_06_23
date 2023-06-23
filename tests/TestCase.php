<?php

namespace Tests;

use Database\Seeders\LanguageSeeder;
use Database\Seeders\PostSeeder;
use Database\Seeders\PostTranslationSeeder;
use Database\Seeders\TagSeeder;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    public function setUp(): void
    {
        parent::setUp();

        $this->seed(PostSeeder::class);
        $this->seed(TagSeeder::class);
        $this->seed(LanguageSeeder::class);
        $this->seed(PostTranslationSeeder::class);
    }
}
