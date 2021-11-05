<?php

namespace App\Http\Controllers\Article;

use Illuminate\Http\Request;
use App\Models\Article\Article;
use App\Models\Article\Solution;
use App\Http\Controllers\ApiController;

class ArticleSolutionVoteController extends ApiController {

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Article $article, Solution $solution){

    $article->isAssociatedWith($solution);
    return $this->successResponse($solution);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, Article $article, Solution $solution){

    $article->isAssociatedWith($solution);
    $solution->votes()->firstOrCreate([ 'user_id' => $request->user()->id ]);
    $solution->load('votes')->loadCount('votes');
    return $this->successResponse($solution);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Article\SolutionVote  $articleSolution
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request, Article $article, Solution $solution){

    $article->isAssociatedWith($solution);
    $solution->votes()->where( 'user_id', $request->user()->id )->delete();
    $solution->load('votes')->loadCount('votes');
    $this->resetAutoIncrement('ArticleSolutionVotes');
    return $this->successResponse($solution);
  }
}
