<?php

namespace Database\Factories\Article;

use App\Models\User;
use App\Models\Article\Article;
use App\Models\Article\Solution;
use Illuminate\Database\Eloquent\Factories\Factory;

class SolutionFactory extends Factory {

  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Solution::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition(){

    return [
      'user_id' => User::all()->random()->id,
      'article_id' => Article::all()->random()->id,
      'description' => $this->faker->text(100),
      'created_at' => now(),
      'updated_at' => now()
    ];
  }
}
