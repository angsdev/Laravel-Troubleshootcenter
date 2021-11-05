<?php

namespace App\Http\Controllers\Article;

use Illuminate\Http\Request;
use App\Models\Article\Article;
use App\Models\Article\Solution;
use App\Http\Controllers\ApiController;

class ArticleSolutionController extends ApiController {

  /**
   * Validation rules.
   *
   * @var array
   */
  protected $rules = [
    'user_id' => 'sometimes|exists:Users,id|required',
    'description' => 'sometimes|string|required',
  ];

  /**
   * Setup the new controller instance.
   */
  public function __construct(){

    $this->authorizeResource(Article::class);
    $this->authorizeResource(Solution::class);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Article $article){

    return $this->successResponse($article->solutions);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, Article $article){

    $input = $request->validate($this->rules);
    $solution = $article->solutions()->create($input);
    return $this->successResponse($solution, 201);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Article\Solution  $articleSolution
   * @return \Illuminate\Http\Response
   */
  public function show(Article $article, Solution $solution){

    $article->isAssociatedWith($solution);
    return $this->successResponse($solution);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Article\Solution  $articleSolution
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Article $article, Solution $solution){

    $article->isAssociatedWith($solution);
    $solution->customUpdate($this->rules);
    return $this->successResponse($solution);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Article\Solution  $articleSolution
   * @return \Illuminate\Http\Response
   */
  public function destroy(Article $article, Solution $solution){

    $article->isAssociatedWith($solution);
    $solution->delete();
    $solution->resetAutoIncrement();
    return $this->successResponse($solution);
  }
}
