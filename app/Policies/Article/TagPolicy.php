<?php

namespace App\Policies\Article;

use App\Models\User;
use App\Models\Article\Tag;
use Illuminate\Auth\Access\HandlesAuthorization;

class TagPolicy {

  use HandlesAuthorization;

  /**
   * Determine whether the user can view any models.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function viewAny(User $user){

    if($user->hasPermissionTo('view any tag')) return true;
  }

  /**
   * Determine whether the user can view the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Article\Tag  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function view(User $user, Tag $model){

    if($user->hasPermissionTo('view any tag') || $user->hasPermissionTo('view tag')) return true;
  }

  /**
   * Determine whether the user can create models.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function create(User $user){

    if($user->hasPermissionTo('create tag')) return true;
  }

  /**
   * Determine whether the user can update the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Tag  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function update(User $user, Tag $model){

    if($user->hasPermissionTo('update tag')) return true;
  }

  /**
   * Determine whether the user can delete the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Tag  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function delete(User $user, Tag $model){

    if($user->hasPermissionTo('delete tag')) return true;
  }
}
