<?php

use brickspace\middleware\Auth;
use brickspace\controller\UsersController;

header("Content-type: application/json");
if(!Auth::Auth()) {
  die(json_encode(["status" => "error", "error" => "Not logged in"]));
}
include($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");

$avatar = UsersController::GetByID($conn, $_SESSION['UserID'])['avatar_link'];
echo json_encode(["status" => "ok", "avatar" => $avatar]);

?>