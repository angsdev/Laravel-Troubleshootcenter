<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Article\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy {

  use HandlesAuthorization;

  /**
   * Determine whether the user can view any models.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function viewAny(User $user){

    if($user->hasPermissionTo('view any article comment')) return true;
  }

  /**
   * Determine whether the user can view the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Article\Comment  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function view(User $user, Comment $model){

    if(($user->hasPermissionTo('view article comment') && $user->id === $model->user->id) ||
        $user->hasPermissionTo('view any article comment')) return true;
  }

  /**
   * Determine whether the user can create models.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function create(User $user){

    if($user->hasPermissionTo('create article comment')) return true;
  }

  /**
   * Determine whether the user can update the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Article\Comment  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function update(User $user, Comment $model){

    if(($user->hasPermissionTo('update article comment') && $user->id === $model->user->id) ||
        $user->hasPermissionTo('update any article comment')) return true;
  }

  /**
   * Determine whether the user can delete the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Article\Comment  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function delete(User $user, Comment $model){

    if(($user->hasPermissionTo('delete article comment') && $user->id === $model->user->id) ||
        $user->hasPermissionTo('delete any article comment')) return true;
  }
}
