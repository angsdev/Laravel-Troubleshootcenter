<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class PasswordController extends ApiController {

  /**
   * Validation rules.
   *
   * @var array
   */
  protected $rules = [
    'email' => 'exists:Users,email|email|required'
  ];

  /**
   * Reset email verification.
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function forgotPassword(Request $request){

    $input = $request->validate($this->rules);
    $status = Password::sendResetLink($input);
    return (!$status === Password::RESET_LINK_SENT) ?
            $this->failureResponse([ 'message' => $status ], 403) :
            $this->successResponse([ 'message' => $status ]);
  }

  /**
   * Re-send email verification.
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function resetPassword(Request $request){

    $this->rules = array_merge($this->rules, [ 'token' => 'string|required', 'password' => 'string|confirmed|required' ]);
    $input = $request->validate($this->rules);
    $status = Password::reset($input, function($user, $password){

      $user->forceFill([ 'password' => Hash::make($password), 'remember_token' => Str::random(60) ])->save();
      $user->tokens()->delete();
      event(new PasswordReset($user));
    });
    return (!$status === Password::PASSWORD_RESET) ?
            $this->failureResponse(['message' => $status], 500) :
            $this->successResponse(['message' => 'Password reseted successfully']);
  }
}
