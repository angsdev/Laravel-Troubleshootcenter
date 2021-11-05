<?php

namespace Database\Seeders;

use App\Models\Article\Comment;
use Illuminate\Database\Seeder;

class ArticleCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Comment::factory(10)->create();
    }
}
