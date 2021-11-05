<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Article\Article;
use App\Http\Controllers\ApiController;

class UserArticleController extends ApiController {

  /**
   * Validation rules.
   *
   * @var array
   */
  protected $rules = [
    'title' => 'sometimes|unique:Articles|string|required',
    'description' => 'sometimes|string|required',
  ];

  /**
   * Setup the new controller instance.
   */
  public function __construct(){

    $this->authorizeResource(User::class);
    $this->authorizeResource(Article::class);
  }

  /**
   * Display a listing of the resource.
   *
   * @param \App\Models\User $user
   * @return \Illuminate\Http\Response
   */
  public function index(User $user){

    return $this->successResponse($user->articles);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\User $user
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, User $user){

    $input = $request->validate($this->rules);
    $article = $user->articles()->create($input);
    return $this->successResponse($article, 201);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\User $user
   * @param  \App\Models\Article\Article $article
   * @return \Illuminate\Http\Response
   */
  public function show(User $user, Article $article){

    $user->isAssociatedWith($article);
    return $this->successResponse($article);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\User $user
   * @param  \App\Models\Activity  $activity
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, User $user, Article $article){

    $user->isAssociatedWith($article);
    $article->customUpdate($this->rules);
    return $this->successResponse($article);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param \App\Models\User $user
   * @param \App\Models\Article\Article $article
   * @return \Illuminate\Http\Response
   */
  public function destroy(User $user, Article $article){

    $user->isAssociatedWith($article);
    $article->delete();
    $article->resetAutoIncrement();
    return $this->successResponse($article);
  }
}
