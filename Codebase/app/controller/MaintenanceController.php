<?php

namespace brickspace\controller;

use brickspace\middleware\Auth;

class MaintenanceController {
  /**
   * test
   */
  public static function Check($conn): bool
  {
    // TODO: check if maintenance mode is active
    $sql = "SELECT * FROM site_settings WHERE id = 1";
    $result = $conn->query($sql);
    $row = $result->fetch();

    if($row['maintenance'] == 1) {
      MaintenanceController::Redirect();
    }
    return false;
  }

  private static function Redirect() {
    // TODO: redirect to maintenance page
    if($_SERVER['HTTP_HOST'] != '/maintenance' && @$_SESSION['maintenance'] != 1) {
      header('location: /maintenance');
      die;
    }
  }
  // OTHER TODO:'s
  // Create the maintenance view
}