<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy {

  use HandlesAuthorization;

  /**
   * Determine whether the user can view any models.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function viewAny(User $user){

    if($user->hasPermissionTo('view any role')) return true;
  }

  /**
   * Determine whether the user can view the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Role  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function view(User $user, Role $model){

    if(($user->hasPermissionTo('view role') && $user->roles->contains('id', $model->id)) ||
        $user->hasPermissionTo('view any role')) return true;
  }

  /**
   * Determine whether the user can create models.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function create(User $user){

    if($user->hasPermissionTo('create role')) return true;
  }

  /**
   * Determine whether the user can update the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Role  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function update(User $user, Role $model){

    if($user->hasPermissionTo('update role')) return true;
  }

  /**
   * Determine whether the user can delete the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Role  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function delete(User $user, Role $model){

    if($user->hasPermissionTo('delete role')) return true;
  }
}
