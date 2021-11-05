<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class UserPermissionController extends ApiController {

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

    $this->authorizeResource(User::class);
    $this->authorizeResource(Permission::class);
  }

  /**
   * Display a listing of the resource.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function index(User $user){

    return $this->successResponse($user->permissions);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, User $user){

    $input = $request->validate($this->rules);
    $user->givePermissionTo($input)->load('permissions');
    return $this->successResponse($user);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Permission  $permission
   * @return \Illuminate\Http\Response
   */
  public function show(User $user, Permission $permission){

    $user->isAssociatedWith($permission);
    return $this->successResponse($permission);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\User  $user
   * @param  \App\Models\Permission  $permission
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, User $user){

    $input = $request->validate($this->rules);
    $user->syncPermissions($input)->load('permissions');
    return $this->successResponse($user);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Permission  $permission
   * @return \Illuminate\Http\Response
   */
  public function destroy(User $user, Permission $permission){

    $user->isAssociatedWith($permission)->revokePermissionTo($permission)->load('permissions');
    $this->resetAutoIncrement('UserHasPermissions');
    return $this->successResponse($user);
  }
}
