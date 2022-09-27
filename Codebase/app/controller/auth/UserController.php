<?php 

namespace brickspace\controller\auth;

use brickspace\middleware\Auth;

class UserController {
  public static function Currency($conn) {
    if(Auth::Auth()) {
      $currency = $conn->prepare("SELECT cubes FROM users WHERE user_id=?");
      $currency->execute([$_SESSION['UserID']]);
      $currency = $currency->fetch();
      return $currency['cubes'];
    }
  }
}