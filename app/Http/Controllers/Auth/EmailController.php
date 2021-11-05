<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailController extends ApiController {

  /**
   * Verify user email.
   *
   * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest $request
   * @return \Illuminate\Http\Response
   */
  public function verifyEmail(EmailVerificationRequest $request){

    $request->fulfill();
    return $this->successResponse('Account verified.');
  }

  /**
   * Re-send email verification.
   *
   * @param  Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function resendEmailVerification(Request $request){

    $request->user()->sendEmailVerificationNotification();
    return $this->successResponse('Verification email re-sent.');
  }
}
