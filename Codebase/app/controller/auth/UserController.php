<?php 

namespace brickspace\controller\auth;

use brickspace\middleware\Auth;

class UserController {
  public static function Currency() {
    Auth::Require();
    include($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
    $currency = $conn->prepare("SELECT cubes FROM users WHERE user_id=?");
    $currency->execute([$_SESSION['UserID']]);
    $currency = $currency->fetch();
    return $currency['cubes'];
  }
}