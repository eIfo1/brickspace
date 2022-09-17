<?php
namespace brickspace\middleware;
class Auth {
  /**
   * Checks if the user is authenticated
   */
  public static function Auth() {
    if(@$_SESSION['UserID']) {
      return true;
    }
    return false;
  }
  /**
   * Checks if the user is not authenticated, and if so, redirects them to the login page.
   */
  public static function Require() {
    if(!Auth::Auth()) {
      header('location: /login');
      exit();
    }
    return;
  }
  /**
   * Checks if the user is authenticated, and if so, returns them to the dashboard. This is for pages that are disallowed to users that are signed in.
   */
  public static function Deny() {
    if(Auth::Auth()) {
      header('location: /dashboard');
      exit();
    }
    return;
  }

  public static function UpdateUser($pdo) {
    $statement = $pdo->prepare("UPDATE users SET user_updated = CURRENT_TIMESTAMP WHERE user_id = :user_id");
    $statement->execute(array(':user_id' => $_SESSION['UserID']));
  }
}