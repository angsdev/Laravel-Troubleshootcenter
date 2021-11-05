<?php

namespace App\Traits;

use App\Traits\ModelHelpers;

/**
 * Trait to add to the user model aditional features.
 */
trait UserHelpers {

  use ModelHelpers;

  /**
   * Create token for the current user and return it ordered along it type.
   *
   * @return Array
   */
  public function generateToken(){

    $token = $this->createToken('auth_token')->plainTextToken;
    $tokenInfo = [ 'access_token' => $token, 'token_type' => 'Bearer' ];
    return $tokenInfo;
  }
}
