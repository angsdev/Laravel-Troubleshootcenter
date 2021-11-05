<?php

namespace App\Traits;

use App\Models\Permission;
use Exception;

/**
 * Trait to handle api responses
 */
trait PermissionHelpers {

  /**
   * Determine if the model may perform the given permission.
   *
   * @param \App\Models\Permission[]|String[]|Int[] $permission
   * @return bool
   */
  public function hasPermissionTo($permission){

    return $this->hasDirectPermission($permission) || $this->hasPermissionViaRole($permission);
  }

  /**
   * Determine if the model has the given permission.
   *
   * @param \App\Models\Permission[]|String[]|Int[] $permission
   * @return bool
   */
  public function hasDirectPermission(Permission|String|Int $permission){

    if($this->permissions->isEmpty()) return false;
    $handle = [
      'integer' => fn() => $this->permissions->contains('id', $permission),
      'string' => fn() => $this->permissions->contains('name', $permission),
      'object' => fn() => $this->permissions->contains('id', $permission->id)
    ];
    $type = gettype($permission);
    return $handle[$type]();
  }

  /**
   * Determine if the model has, via roles, the given permission.
   *
   * @param \App\Models\Permission[]|String[]|Int[] $permission
   * @return bool
   */
  public function hasPermissionViaRole(Permission|String|Int $permission){

    $handle = [
      'integer' => fn() => Permission::firstWhere('id', $permission),
      'string' => fn() => Permission::firstWhere('name', $permission),
      'object' => fn() => Permission::firstWhere('id', $permission->id)
    ];
    $type = gettype($permission);
    $permission = $handle[$type]();
    return $this->hasRole($permission?->roles ?: throw new Exception('The given permission doesn\'t exist.'));
  }

  /**
   * Grant the given permission(s) to a role.
   *
   * @param \Illuminate\Support\Collection|\App\Models\Permission[]|String[]|Int[] $permissions
   * @return $this
   */
  public function givePermissionTo($permissions){

    $permissions = collect($permissions)
      ->transform(fn($permission) => Permission::findMatches(['id' => $permission, 'fields' => 'id|name']))
      ->filter(fn($permission) => $permission !== null)
      ->pluck('id')
      ->toArray();

    $this->permissions()->sync($permissions, false);
    return $this;
  }

  /**
   * Revoke the given permission.
   *
   * @param \App\Models\Permission[]|Array[]|string[] $permission
   * @return $this
   */
  public function revokePermissionTo($permission){

    $permission = collect($permission)
      ->filter(fn($permission) => $this->permissions->contains(fn($val) => $val->id === $permission || $val->name === $permission))
      ->transform(fn($permission) => Permission::findMatches(['id' => $permission, 'fields' => 'id|name']))
      ->pluck('id')
      ->unique()
      ->toArray();

    $this->permissions()->detach($permission);
    return $this;
  }

  /**
   * Revoke every given permissions.
   *
   * @return $this
   */
  public function revokeAllPermissions(){

    $this->permissions()->detach();
    return $this;
  }

  /**
   * Remove all current permissions and set the given ones.
   *
   * @param \Illuminate\Support\Collection[]|\App\Models\Permission[]|Array[]|String[] $permissions
   * @return $this
   */
  public function syncPermissions($permissions){

    $this->revokeAllPermissions();
    $this->givePermissionTo($permissions);
    return $this;
  }
}
