<?php

namespace Database\Factories\Article;

use App\Models\User;
use App\Models\Article\Vote;
use App\Models\Article\Solution;
use Illuminate\Database\Eloquent\Factories\Factory;

class VoteFactory extends Factory {

  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Vote::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition(){

    return [
      'user_id' => User::all()->random()->id,
      'solution_id' => Solution::all()->random()->id,
      'created_at' => now(),
      'updated_at' => now()
    ];
  }
}
