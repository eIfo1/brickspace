<?php 

namespace brickspace\controller\auth;
use brickspace\middleware\Auth;
use brickspace\helpers\Purify;

class StatusController {
  public static function Update() {
    include($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
    Auth::Require();
    $UserID = $_SESSION['UserID'];
    $Status = $_POST['status'];
    $Status = Purify::purify($Status);
    if(!is_csrf_valid()) {
      header("location: /dashboard");
      exit();
    }
    // error handling
    if (!preg_match("/^[ a-zA-Z0-9_',.|*&^%$#@!()?]*$/", $Status)) {
      $_SESSION["error"] = "Status can only contain letters, numbers, and punctuation.";
      header("location: /dashboard");
      exit();
    }
    if (strlen($Status) > 50) {
      $_SESSION["error"] = "Status must be less than 50 characters.";
      header("location: /dashboard");
      exit();
    }

    if (empty($Status)) {
      $_SESSION["error"] = "Please fill in all fields";
      header("location: /dashboard");
      exit();
    }

    // TODO: check for flood and log action
    $statement = $conn->prepare("UPDATE users SET user_status = :status WHERE user_id = :user_id");
    $statement->execute(array(':status' => $Status, ':user_id' => $UserID));
    $_SESSION["note"] = "Status updated!";
    header("Location: /dashboard");
    exit();
  }
}