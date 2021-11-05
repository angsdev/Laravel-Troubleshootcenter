<?php

namespace Database\Factories\Article;

use App\Models\User;
use App\Models\Article\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory {

  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Article::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition(){

    return [
      'user_id' => User::all()->random()->id,
      'title' => $this->faker->unique()->title(),
      'description' => $this->faker->text(100),
      'created_at' => now(),
      'updated_at' => now()
    ];
  }
}
