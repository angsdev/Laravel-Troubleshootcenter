<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\GeneralHelpers;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\ApiController;

class LoginController extends ApiController {

  use GeneralHelpers;

  /**
   * Validation Rules
   *
   * @var array
   */
  protected $rules = [
    'username' => 'exists_any:Users,email,phone,username|string|required',
    'password' => 'string|required'
  ];

  /**
   * Validate user credentials to give authentication token.
   *
   * @param  \App\Models\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function login(Request $request){

    $input = $request->validate($this->rules);
    $user = User::findMatches(['id' => $input['username'], 'fields' => 'email|phone|username']);
    if(!Hash::check($input['password'], $user->password)) return $this->failureResponse('Invalid password.', 401);
    $data = array_merge($user->toArray(), $user->generateToken());
    return $this->successResponse($data);
  }

  /**
   * Remove authentication token it mean, that close session.
   *
   * @param  \App\Models\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function logout(Request $request){

    $request->user()->currentAccessToken()->delete();
    $this->resetAutoIncrement('personal_access_tokens');
    return $this->successResponse('Session closed.');
  }
}
