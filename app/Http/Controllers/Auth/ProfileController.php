<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ProfileController extends ApiController {

  /**
   * Get user profile info.
   *
   * @param  \Illuminate\Http\Request $request
   * @return Illuminate\Http\Response
   */
  public function index(Request $request){

    $user = $request->user()->load(
      'roles', 'roles.permissions', 'permissions',
      'articles', 'articles.comments', 'articles.solutions',
      'articles.tags'
    );
    return $this->successResponse($user);
  }

  /**
   * Get user profile roles.
   *
   * @param  \Illuminate\Http\Request $request
   * @return Illuminate\Http\Response
   */
  public function roles(Request $request){

    $roles = $request->user()->roles->load('permissions');
    return $this->successResponse($roles);
  }

  /**
   * Get user profile permissions.
   *
   * @param  \Illuminate\Http\Request $request
   * @return Illuminate\Http\Response
   */
  public function permissions(Request $request){

    $permissions = $request->user()->permissions;
    return $this->successResponse($permissions);
  }

  /**
   * Get user profile articles.
   *
   * @param  \Illuminate\Http\Request $request
   * @return Illuminate\Http\Response
   */
  public function articles(Request $request){

    $articles = $request->user()->articles->load('comments', 'solutions');
    return $this->successResponse($articles);
  }

  /**
   * Get user profile comments.
   *
   * @param  \Illuminate\Http\Request $request
   * @return Illuminate\Http\Response
   */
  public function comments(Request $request){

    $comments = $request->user()->articles->comments;
    return $this->successResponse($comments);
  }

  /**
   * Get user profile solutions.
   *
   * @param  \Illuminate\Http\Request $request
   * @return Illuminate\Http\Response
   */
  public function solutions(Request $request){

    $solutions = $request->user()->articles->solutions;
    return $this->successResponse($solutions);
  }
}
