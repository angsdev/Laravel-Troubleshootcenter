<?php

namespace Database\Seeders;

use Database\Seeders\TagSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\ArticleSeeder;
use Database\Seeders\ArticleCommentSeeder;
use Database\Seeders\ArticleSolutionSeeder;
use Database\Seeders\ArticleSolutionVoteSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
          PermissionSeeder::class,
          RoleSeeder::class,
          UserSeeder::class,
          TagSeeder::class,
          ArticleSeeder::class,
          ArticleCommentSeeder::class,
          ArticleSolutionSeeder::class,
          ArticleSolutionVoteSeeder::class,
        ]);
    }
}
