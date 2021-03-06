<?php

namespace Database\Seeders;

use App\Models\Article\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Tag::factory(5)->create();
    }
}
