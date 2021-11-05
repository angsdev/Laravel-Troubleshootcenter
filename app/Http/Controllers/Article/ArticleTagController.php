<?php

namespace App\Http\Controllers\Article;

use App\Models\Article\Tag;
use Illuminate\Http\Request;
use App\Models\Article\Article;
use App\Http\Controllers\ApiController;

class ArticleTagController extends ApiController {

  /**
   * Validation rules.
   *
   * @var array
   */
  protected $rules = [
    'category_id' => 'exists:Tags,id|integer|required',
  ];

  /**
   * Setup the new controller instance.
   */
  public function __construct(){

    $this->authorizeResource(Article::class);
    $this->authorizeResource(Tag::class);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Article $article){

    return $this->successResponse($article->tags);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, Article $article){

    $input = $request->validate($this->rules);
    $article->tags()->sync($input, false);
    $article->load('tags');
    return $this->successResponse($article);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Article\SolutionVote  $articleSolutionVote
   * @return \Illuminate\Http\Response
   */
  public function show(Article $article, Tag $tag){

    $article->isAssociatedWith($tag);
    return $this->successResponse($tag);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Article\Tag  $tag
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Article $article){

    $input = $request->validate($this->rules);
    $article->tags()->sync($input);
    $article->load('tags');
    return $this->successResponse($article->tags);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Article\SolutionVote  $articleSolutionVote
   * @return \Illuminate\Http\Response
   */
  public function destroy(Article $article, Tag $tag){

    $article->isAssociatedWith($tag);
    $article->tags()->detach($tag->id);
    $this->resetAutoIncrement('ArticleHasTags');
    return $this->successResponse($tag);
  }
}
