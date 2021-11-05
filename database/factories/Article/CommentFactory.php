<?php

namespace Database\Factories\Article;

use App\Models\User;
use App\Models\Article\Article;
use App\Models\Article\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory {

  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Comment::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition(){

    return [
      'user_id' => User::all()->random()->id,
      'article_id' => Article::all()->random()->id,
      'content' => $this->faker->text(50),
      'created_at' => now(),
      'updated_at' => now()
    ];
  }
}
