<?php

use brickspace\controller\auth\UserController;
use brickspace\middleware\Auth;

require($_SERVER['DOCUMENT_ROOT'] . "/api/REST_api.php");
if(Auth::Auth()) {
  if (isset($_POST["limb"]) && isset($_POST["hex"])) {
    try {
      UserController::Avatar_Change_Color($_POST["limb"], $_POST["hex"]);
      $rest->success();
    } catch (Exception $e) {
      $rest->error($e->getMessage());
    }
  } else {
    $rest->error("Missing parameters");
  }
} else {
  $rest->error("You're not logged in!");
}