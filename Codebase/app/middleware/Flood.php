<?php 

namespace brickspace\middleware;
use pdo;

class Flood {
  // todo: finish this class and implement it
  public static function CheckFlood($conn, $time) {
    Auth::Require();    
    // check if flood
    $c = $conn->prepare("SELECT user_flood FROM users WHERE user_id = :user_id");
    $c->execute(array(':user_id' => $_SESSION['UserID']));
    $e = $c->fetch(PDO::FETCH_ASSOC);
    $diff = strtotime(date("Y-m-d H:i:s")) - strtotime($e['user_flood']);
    if($diff < $time) {
      return true;
    }
    return false;
  }
  
  public static function Flood($page, $time, $conn) {
    // if flood then throw error
    if(Flood::CheckFlood($conn, $time)) {
      header('location: '.$page);
      die;
    }
  }

  public static function SetFlood($conn) {
    Auth::Require();
    $sql = "UPDATE users SET user_flood = NOW() WHERE user_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array(':user_id' => $_SESSION['UserID']));
  }
}