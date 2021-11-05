<?php

namespace App\Http\Controllers\Article;

use Illuminate\Http\Request;
use App\Models\Article\Article;
use App\Models\Article\Comment;
use App\Http\Controllers\ApiController;

class ArticleCommentController extends ApiController {

  /**
   * Validation rules.
   *
   * @var array
   */
  protected $rules = [
    'user_id' => 'sometimes|exists:Users,id|string|required',
    'content' => 'sometimes|string|required',
  ];

  /**
   * Setup the new controller instance.
   */
  public function __construct(){

    $this->authorizeResource(Article::class);
    $this->authorizeResource(Comment::class);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Article $article){

    return $this->successResponse($article->comments);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, Article $article){

    $input = $request->validate($this->rules);
    $comment = $article->comments()->create($input);
    return $this->successResponse($comment, 201);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Article\Comment  $comment
   * @return \Illuminate\Http\Response
   */
  public function show(Article $article, Comment $comment){

    $article->isAssociatedWith($comment);
    return $this->successResponse($comment);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Article\Comment  $articleComment
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Article $article, Comment $comment){

    $article->isAssociatedWith($comment);
    $comment->customUpdate($this->rules);
    return $this->successResponse($comment);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Article\Comment  $articleComment
   * @return \Illuminate\Http\Response
   */
  public function destroy(Article $article, Comment $comment){

    $article->isAssociatedWith($comment);
    $comment->delete();
    $comment->resetAutoIncrement();
    return $this->successResponse($comment);
  }
}
