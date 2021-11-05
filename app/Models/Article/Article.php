<?php

namespace App\Models\Article;

use App\Models\User;
use App\Models\Article\Tag;
use App\Traits\ModelHelpers;
use App\Models\Article\Comment;
use App\Models\Article\Solution;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model {

  use ModelHelpers, HasFactory;

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'Articles';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'user_id',
    'title',
    'description',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'user_id',
    'pivot',
  ];

  /**
   * The relations to eager load on every query.
   *
   * @var array
   */
  protected $with = [
    'tags',
    'comments',
    'solutions',
    'solutions.votes',
  ];

  /**
   * Get tags associated with the article.
   *
   * @return belongsTo
   */
  public function user(){

    return $this->belongsTo(User::class);
  }

  /**
   * Get tags associated with the article.
   *
   * @return belongsToMany
   */
  public function tags(){

    return $this->belongsToMany(Tag::class, 'ArticleHasTags', 'article_id', 'category_id');
  }

  /**
   * Get comments associated with the article.
   *
   * @return hasMany
   */
  public function comments(){

    return $this->hasMany(Comment::class);
  }

  /**
   * Get solutions associated with the article.
   *
   * @return hasOne
   */
  public function solutions(){

    return $this->hasMany(Solution::class);
  }
}
