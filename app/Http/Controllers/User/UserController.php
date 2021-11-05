<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\ApiController;

class UserController extends ApiController {

  /**
   * Validation rules.
   *
   * @var array
   */
  protected $rules = [
    'firstname' => 'sometimes|string|required',
    'lastname' => 'sometimes|string|required',
    'username' => 'sometimes|unique:Users|string|required',
    'phone' => 'sometimes|unique:Users|string|required',
    'email' => 'sometimes|unique:Users|email|required',
    'password' => 'sometimes|confirmed|required'
  ];

  /**
   * Setup the new controller instance.
   */
  public function __construct(){

    $this->authorizeResource(User::class);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(){

    return $this->successResponse(User::all());
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request){

    $input = $request->validate($this->rules);
    $input['password'] = Hash::make($input['password']);

    $user = User::create($input);
    $token = (auth()->check()) ? [] : $user->generateToken();
    $data = array_merge($user->toArray(), $token);
    event(new Registered($user));
    return $this->successResponse($data, 201);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function show(User $user){

    return $this->successResponse($user);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, User $user){

    $user->customUpdate($this->rules);
    return $this->successResponse($user);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function destroy(User $user){

    $user->delete();
    $user->resetAutoIncrement();
    return $this->successResponse($user);
  }
}
