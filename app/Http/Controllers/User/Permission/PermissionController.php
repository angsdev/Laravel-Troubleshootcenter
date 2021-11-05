<?php

namespace App\Http\Controllers\User\Permission;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class PermissionController extends ApiController {

  /**
   * Validation rules.
   *
   * @var array
   */
  protected $rules = [
    'name' => 'sometimes|unique:Permissions|string|required',
    'description' => 'sometimes|string|nullable',
  ];

  /**
   * Setup the new controller instance.
   */
  public function __construct(){

    $this->authorizeResource(Permission::class);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(){

    return $this->successResponse(Permission::all());
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request){

    $input = $request->validate($this->rules);
    $permission = Permission::create($input);
    return $this->successResponse($permission, 201);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Permission  $permission
   * @return \Illuminate\Http\Response
   */
  public function show(Permission $permission){

    return $this->successResponse($permission);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Permission  $permission
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Permission $permission){

    $permission->customUpdate($this->rules);
    return $this->successResponse($permission);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Permission  $permission
   * @return \Illuminate\Http\Response
   */
  public function destroy(Permission $permission){

    $permission->delete();
    $permission->resetAutoIncrement();
    return $this->successResponse($permission);
  }
}
