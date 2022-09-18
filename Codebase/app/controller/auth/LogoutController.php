<?php

namespace brickspace\controller\auth;
use brickspace\middleware\Auth;


class LogoutController {
  public static function Logout() {
    Auth::Require();
    if(!is_csrf_valid()) {
      $_SESSION['error'] = "CSRF invalid!";
      header('location: /dashboard');
      exit();
    }
    session_unset();
    session_destroy();
    header('location: /');
    exit();
  }
}