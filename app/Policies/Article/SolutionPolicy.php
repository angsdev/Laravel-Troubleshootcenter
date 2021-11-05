<?php

namespace App\Policies\Article;

use App\Models\User;
use App\Models\Article\Solution;
use Illuminate\Auth\Access\HandlesAuthorization;

class SolutionPolicy {

  use HandlesAuthorization;

  /**
   * Determine whether the user can view any models.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function viewAny(User $user){

    if($user->hasPermissionTo('view any solution')) return true;
  }

  /**
   * Determine whether the user can view the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Article\Solution  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function view(User $user, Solution $model){

    if(($user->hasPermissionTo('view article solution') && $user->id === $model->user->id) ||
        $user->hasPermissionTo('view any article solution')) return true;
  }

  /**
   * Determine whether the user can create models.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function create(User $user){

    if($user->hasPermissionTo('create solution')) return true;
  }

  /**
   * Determine whether the user can update the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Article\Solution  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function update(User $user, Solution $model){

    if(($user->hasPermissionTo('update article solution') && $user->id === $model->user->id) ||
        $user->hasPermissionTo('update any article solution')) return true;
  }

  /**
   * Determine whether the user can delete the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Article\Solution  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function delete(User $user, Solution $model){

    if(($user->hasPermissionTo('delete article solution') && $user->id === $model->user->id) ||
        $user->hasPermissionTo('delete any article solution')) return true;
  }
}
