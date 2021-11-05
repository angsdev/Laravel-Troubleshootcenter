<?php

namespace App\Http\Controllers\User\Role;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class RolePermissionController extends ApiController {

  /**
   * Validation rules.
   *
   * @var array
   */
  protected $rules = [
    'permission' => 'exists:Permissions,id|integer|required'
  ];

  /**
   * Setup the new controller instance.
   */
  public function __construct(){

    $this->authorizeResource(Role::class);
    $this->authorizeResource(Permission::class);
  }

  /**
   * Display a listing of the resource.
   *
   * @param  \App\Models\Role  $role
   * @return \Illuminate\Http\Response
   */
  public function index(Role $role){

    return $this->successResponse($role->permissions);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Role  $role
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, Role $role){

    $input = $request->validate($this->rules);
    $role->givePermissionTo($input)->load('permissions');
    return $this->successResponse($role);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Role  $role
   * @param  \App\Models\Permission  $permission
   * @return \Illuminate\Http\Response
   */
  public function show(Role $role, Permission $permission){

    $role->isAssociatedWith($permission);
    return $this->successResponse($permission);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Role  $role
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Role $role){

    $input = $request->validate($this->rules);
    $role->syncPermissions($input)->load('permissions');
    return $this->successResponse($role);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Role  $role
   * @param  \App\Models\Permission  $permission
   * @return \Illuminate\Http\Response
   */
  public function destroy(Role $role, Permission $permission){

    $role->isAssociatedWith($permission)->revokePermissionTo($permission)->load('permissions');
    $this->resetAutoIncrement('RoleHasPermissions');
    return $this->successResponse($role);
  }
}
