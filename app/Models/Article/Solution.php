<?php

namespace App\Models\Article;

use App\Models\User;
use App\Models\Article\Vote;
use App\Traits\ModelHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Solution extends Model {

  use ModelHelpers, HasFactory;

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'ArticleSolutions';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'user_id',
    'article_id',
    'description',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'pivot',
  ];

  /**
   * The relations to eager load on every query.
   *
   * @var array
   */
  protected $with = [
    'votes'
  ];

  /**
   * The relationship counts that should be eager loaded on every query.
   *
   * @var array
   */
  protected $withCount = [
    'votes',
  ];

  /**
   * Get user associated with the article solution.
   *
   * @return belongsTo
   */
  public function user(){

    return $this->belongsTo(User::class);
  }

  /**
   * Get votes associated with the article solution.
   *
   * @return hasMany
   */
  public function votes(){

    return $this->hasMany(Vote::class);
  }
}
