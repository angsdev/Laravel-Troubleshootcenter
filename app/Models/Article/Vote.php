<?php

namespace App\Models\Article;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Vote extends Pivot {

  use HasFactory;

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'ArticleSolutionVotes';

  /**
   * Indicates if the IDs are auto-incrementing.
   *
   * @var bool
   */
  public $incrementing = true;

  /**
   * Get user associated with the article solution vote.
   *
   * @return belongsTo
   */
  public function user(){

    return $this->belongsTo(User::class);
  }

  /**
   * Get user associated with the article solution.
   *
   * @return belongsTo
   */
  public function solution(){

    return $this->belongsTo(User::class);
  }
}
