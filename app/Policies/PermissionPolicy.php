<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy {

  use HandlesAuthorization;

  /**
   * Determine whether the user can view any models.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function viewAny(User $user){

    if($user->hasPermissionTo('view any permission')) return true;
  }

  /**
   * Determine whether the user can view the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Permission  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function view(User $user, Permission $model){

    if(($user->hasPermissionTo('view permission') && $user->permissions->contains('id', $model->id)) ||
        $user->hasPermissionTo('view any permission')) return true;
  }

  /**
   * Determine whether the user can create models.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function create(User $user){

    if($user->hasPermissionTo('create permission')) return true;
  }

  /**
   * Determine whether the user can update the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Permission  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function update(User $user, Permission $model){

    if($user->hasPermissionTo('update permission')) return true;
  }

  /**
   * Determine whether the user can delete the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Permission  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function delete(User $user, Permission $model){

    if($user->hasPermissionTo('delete permission')) return true;
  }
}
