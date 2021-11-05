<?php

namespace Database\Factories\Article;

use App\Models\Article\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory {

  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Tag::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition(){

    return [
      'name' => $this->faker->name(),
      'description' => $this->faker->text(60),
      'created_at' => now(),
      'updated_at' => now()
    ];
  }
}
