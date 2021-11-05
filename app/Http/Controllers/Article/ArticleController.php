<?php

namespace App\Http\Controllers\Article;

use Illuminate\Http\Request;
use App\Models\Article\Article;
use App\Http\Controllers\ApiController;

class ArticleController extends ApiController {

  /**
   * Validation rules.
   *
   * @var array
   */
  protected $rules = [
    'user_id' => 'sometimes|exists:Users,id|integer|required',
    'title' => 'sometimes|unique:Articles,title|string|required',
    'description' => 'sometimes|string|required',
  ];

  /**
   * Setup the new controller instance.
   */
  public function __construct(){

    $this->authorizeResource(Article::class);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(){

    return $this->successResponse(Article::all());
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request){

    $input = $request->validate($this->rules);
    $article = Article::create($input);
    return $this->successResponse($article, 201);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Article  $article
   * @return \Illuminate\Http\Response
   */
  public function show(Article $article){

    return $this->successResponse($article);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Article  $article
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Article $article){

    $article->customUpdate($this->rules);
    return $this->successResponse($article);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Article  $article
   * @return \Illuminate\Http\Response
   */
  public function destroy(Article $article){

    $article->delete();
    $article->resetAutoIncrement();
    return $this->successResponse($article);
  }
}
