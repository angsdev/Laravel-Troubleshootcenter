<?php

namespace App\Http\Controllers\Article\Tag;

use App\Models\Article\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class TagController extends ApiController {

  /**
   * Validation rules.
   *
   * @var array
   */
  protected $rules = [
    'name' => 'sometimes|unique:Tags|string|required',
    'description' => 'sometimes|string|nullable',
  ];

  /**
   * Setup the new controller instance.
   */
  public function __construct(){

    $this->authorizeResource(Tag::class);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(){

    return $this->successResponse(Tag::all());
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request){

    $input = $request->validate($this->rules);
    $tag = Tag::create($input);
    return $this->successResponse($tag, 201);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\ArticleSolutionVote  $articleSolutionVote
   * @return \Illuminate\Http\Response
   */
  public function show(Tag $tag){

    return $this->successResponse($tag);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\ArticleSolutionVote  $articleSolutionVote
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Tag $tag){

    $tag->customUpdate($this->rules);
    return $this->successResponse($tag);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\ArticleSolutionVote  $articleSolutionVote
   * @return \Illuminate\Http\Response
   */
  public function destroy(Tag $tag){

    $tag->delete();
    $tag->resetAutoIncrement();
    return $this->successResponse($tag);
  }
}
