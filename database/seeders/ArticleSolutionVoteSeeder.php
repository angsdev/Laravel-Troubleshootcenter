<?php

namespace Database\Seeders;

use App\Models\Article\Vote;
use Illuminate\Database\Seeder;

class ArticleSolutionVoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

      Vote::factory(5)->create();
    }
}
