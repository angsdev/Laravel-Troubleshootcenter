<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article\Solution;

class ArticleSolutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Solution::factory(5)->create();
    }
}
