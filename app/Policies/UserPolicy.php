<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy {

  use HandlesAuthorization;

  /**
   * Determine whether the user can view any models.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function viewAny(User $user){

    if($user->hasPermissionTo('view any user')) return true;
  }

  /**
   * Determine whether the user can view the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\User  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function view(User $user, User $model){

    if(($user->hasPermissionTo('view user') && $user->id == $model->id) ||
        $user->hasPermissionTo('view any user')) return true;
  }

  /**
   * Determine whether the user can create models.
   *
   * @param  \App\Models\User|Null  $user
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function create(?User $user){

    if((!isset($user) || is_null($user)) ||
        $user->hasPermissionTo('create user')) return true;
  }

  /**
   * Determine whether the user can update the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\User  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function update(User $user, User $model){

    if(($user->hasPermissionTo('update user') && $user->id == $model->id) ||
        $user->hasPermissionTo('update any user')) return true;
  }

  /**
   * Determine whether the user can delete the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\User  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function delete(User $user, User $model){

    if(($user->hasPermissionTo('delete user') && $user->id == $model->id) ||
        $user->hasPermissionTo('delete any user')) return true;
  }
}
