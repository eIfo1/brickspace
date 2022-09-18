<?php 

namespace brickspace\middleware;

class Flood {
  // todo: finish this class and implement it
  private static function CheckFlood() {
    Auth::Require();    
    // check if flood
  }
  
  public static function Flood() {
    // if flood then throw error
  }

  public static function SetFlood() {
    Auth::Require();
    global $conn;
    $sql = "UPDATE users SET user_flood = NOW() WHERE user_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array(':user_id' => $_SESSION['UserID']));
  }
}