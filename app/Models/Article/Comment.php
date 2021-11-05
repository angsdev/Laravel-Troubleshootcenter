<?php

namespace App\Models\Article;

use App\Models\User;
use App\Traits\ModelHelpers;
use App\Models\Article\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model {

  use ModelHelpers, HasFactory;

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'ArticleComments';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'user_id',
    'article_id',
    'content',
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
   * Get user associated with the article comment.
   *
   * @return belongsTo
   */
  public function user(){

    return $this->belongsTo(User::class);
  }

  /**
   * Get article associated with the article comment.
   *
   * @return belongsTo
   */
  public function article(){

    return $this->belongsTo(Article::class);
  }
}
