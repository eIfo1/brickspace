<?php
namespace brickspace\controller\auth;
use brickspace\middleware\Auth;
use brickspace\helpers\Purify;
use pdo;
class WallController {
  public static function Post() {
    include($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
    $message = $_POST['message'];
    $message = Purify::purify($message);
    
    if(!is_csrf_valid()) {
      header('location: /dashboard/');
      exit();
    }
    
    if (!Auth::Auth()) {  
      $_SESSION['error'] = "You must be logged in to post on the wall!";
      header("Location: /login");
      exit();
    }
    
    $creator = $_SESSION['UserID'];
    
    if (empty($message)) {
      $_SESSION['error'] = 'The wall message is empty!';
      header('location: /dashboard/');
      exit();
    }
    
    if(strlen($message) <= 3 || strlen($message) >= 250) {
      $_SESSION['error'] = 'The wall message is either too long or too short!';
      header('location: /dashboard/');
      exit();
    }
    
    // insert 
    $statement = $conn->prepare("INSERT INTO wall (wall_message, wall_creator, wall_created) VALUES (:message, :creator, NOW())");
    $statement->execute(array(':message' => $message, ':creator' => $creator));
    
    $_SESSION['note'] = 'Message posted!';
    header('location: /dashboard/');
    exit();
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