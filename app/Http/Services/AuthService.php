<?php

namespace App\Services;

use App\User;

class AuthService
{
  public function authorization($token)
  {
    return User::where('access_token', $token)->first();
  }
}