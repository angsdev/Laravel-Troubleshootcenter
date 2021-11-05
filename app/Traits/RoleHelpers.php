<?php

namespace App\Traits;

use App\Models\Role;
use Illuminate\Support\Collection;

/**
 * Trait to handle api responses
 */
trait RoleHelpers {

  /**
   * Determine if has given role(s)
   *
   * @param  \Illuminate\Support\Collection[]|\App\Models\Role[]|String[]|Int[] $roles
   * @return boolean
   */
  public function hasRole(Role|Collection|Array|String|Int $roles){

    if($this->roles->isEmpty()) return false;
    $handle = [
      'integer' => fn() => $this->roles->contains('id', $roles),
      'string' => fn() => $this->roles->contains('name', $roles),
      'object' => fn() => ($roles instanceof Role) ? $this->roles->contains('id', $roles->id) : $this->hasRole($roles->toArray()),
      'array' => function() use($roles){
        foreach ($roles as $role){
          if($this->hasRole($role)) return true;
        }
        return false;
      }
    ];
    $type = gettype($roles);
    return $handle[$type]();
  }

  /**
   * Assign the given role to the model.
   *
   * @param \App\Models\Role[]|String[]|Int[] $roles
   * @return $this
   */
  public function assignRole($roles){

    $roles = collect($roles)
      ->transform(fn($role) => Role::findMatches(['id' => $role, 'fields' => 'id|name']))
      ->filter(fn($role) => $role !== null)
      ->pluck('id')
      ->flatten()
      ->toArray();

    $this->roles()->sync($roles, false);
    return $this;
  }

  /**
   * Revoke the given role from the model.
   *
   * @param \App\Models\Role[]|String[]|Int[] $roles
   * @return $this
   */
  public function removeRole($roles){

    $roles = collect($roles)
      ->filter(fn($role) => $this->roles->contains(fn($val) => $val->id === $role || $val->name === $role))
      ->transform(fn($role) => Role::findMatches(['id'=> $role, 'fields' => 'id|name']))
      ->pluck('id')
      ->unique()
      ->toArray();

    $this->roles()->detach($roles);
    return $this;
  }

  /**
   * Revoke every given role from the model.
   *
   * @return $this
   */
  public function removeAllRoles(){

    $this->roles()->detach();
    return $this;
  }

  /**
   * Remove all current roles and set the given ones.
   *
   * @param  \App\Models\Role[]|String[]|Int[]  $roles
   * @return $this
   */
  public function syncRoles($roles){

    $this->removeAllRoles();
    return $this->assignRole($roles);
  }

  /**
   * Determine if user is admin.
   *
   * @return bool
   */
  public function isAdmin(){

    return $this->hasRole('administrator');
  }
}
