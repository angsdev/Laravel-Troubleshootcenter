<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Article\Article;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy {

  use HandlesAuthorization;

  /**
   * Determine whether the user can view any models.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function viewAny(User $user){

    if($user->hasPermissionTo('view any article')) return true;
  }

  /**
   * Determine whether the user can view the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Article\Article  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function view(User $user, Article $model){

    if(($user->hasPermissionTo('view article') && $user->id === $model->user->id) ||
        $user->hasPermissionTo('view any article')) return true;
  }

  /**
   * Determine whether the user can create models.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function create(User $user){

    if($user->hasPermissionTo('create article')) return true;
  }

  /**
   * Determine whether the user can update the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Article\Article  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function update(User $user, Article $model){

    if(($user->hasPermissionTo('update article') && $user->id === $model->user->id) ||
        $user->hasPermissionTo('update any article')) return true;
  }

  /**
   * Determine whether the user can delete the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Article\Article  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function delete(User $user, Article $model){

    if(($user->hasPermissionTo('delete article') && $user->id === $model->user->id) ||
        $user->hasPermissionTo('delete any article')) return true;
  }
}
