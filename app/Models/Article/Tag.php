<?php

namespace App\Models\Article;

use App\Traits\ModelHelpers;
use App\Models\Article\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model {

  use ModelHelpers, HasFactory;

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'Tags';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name',
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
   * Get articles associated with the tag.
   *
   * @return belongsToMany
   */
  public function articles(){

    return $this->belongsToMany(Article::class, 'ArticleHasTags');
  }
}
