<?php

namespace App\Http\Controllers\User;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class UserRoleController extends ApiController {

  /**
   * Validation rules.
   *
   * @var array
   */
  protected $rules = [
    'role' => 'exists:Roles,id|integer|required'
  ];

  /**
   * Setup the new controller instance.
   */
  public function __construct(){

    $this->authorizeResource(User::class);
    $this->authorizeResource(Role::class);
  }

  /**
   * Display a listing of the resource.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function index(User $user){

    return $this->successResponse($user->roles);
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
    $user->assignRole($input)->load('roles', 'roles.permissions');
    return $this->successResponse($user);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Role  $role
   * @return \Illuminate\Http\Response
   */
  public function show(User $user, Role $role){

    $user->isAssociatedWith($role);
    return $this->successResponse($role);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, User $user){

    $input = $request->validate($this->rules);
    $user->syncRoles($input)->load('roles', 'roles.permissions');
    return $this->successResponse($user);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Role  $role
   * @return \Illuminate\Http\Response
   */
  public function destroy(User $user, Role $role){

    $user->isAssociatedWith($role)->removeRole($role)->load('roles', 'roles.permissions');
    $this->resetAutoIncrement('UserHasRoles');
    return $this->successResponse($user);
  }
}
