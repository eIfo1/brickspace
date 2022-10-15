<?php
namespace brickspace\controller\auth;
use brickspace\middleware\Auth;
use brickspace\helpers\Purify;
use brickspace\middleware\Flood;
use pdo;
class WallController {
  public static function Post() {
    include($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
    $message = $_POST['message'];
    $message = Purify::purify($message);
        
    require($_SERVER['DOCUMENT_ROOT'] . "/api/REST_api.php");
    
    if(!is_csrf_valid()) {
      $rest->error("Invalid CSRF!");
      die;
    }
    
    if (!Auth::Auth()) {
      $rest->error("Invalid session!");
      die;
    }
    
    $creator = $_SESSION['UserID'];
    
    if (empty($message)) {
      $rest->error("Empty wall message!");
      die;
    }
    
    if(strlen($message) < 1 || strlen($message) >= 250) {
      $rest->error("Wall message too short or too long!");
      die;
    }

    if(Flood::CheckFlood($conn, "3 seconds") == true) {
      $rest->error("Slow down! You're going too fast!");
      die;
    }

    Flood::SetFlood($conn);
    
    // insert 
    $statement = $conn->prepare("INSERT INTO wall (wall_message, wall_creator, wall_created) VALUES (:message, :creator, NOW())");
    $statement->execute(array(':message' => $message, ':creator' => $creator));

    $rest->success();
  }

  public static function PostAmount($conn, $id) {
    $sql = "SELECT * FROM wall WHERE wall_creator = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array(':user_id' => $id));
    $result = $stmt->fetchAll();
    return count($result);
  }
  public static function GetPosts($conn) {
    $statement = $conn->prepare("SELECT * FROM wall ORDER BY wall_created DESC LIMIT 6");
    // Set offset to the number of posts already shown.
    $statement->execute();
    $wall = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $wall;
  }
}