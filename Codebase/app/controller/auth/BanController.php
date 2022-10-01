<?php 

namespace brickspace\controller\auth;

class BanController {
  public static function Check($conn) {
    // Get user ID from session
    @$id = $_SESSION['UserID'];

    // check if the user is banned
    $query = $conn->prepare("SELECT * FROM bans WHERE receiver = ?");
    $query->execute([$id]);
    $result = $query->fetch();
    // the user is not banned
    if(!$result) {
      return false;
    } 
    // the user is banned, so return true
    return true;
  }

  public static function Get($conn) {
    // Get user ID from session
    @$id = $_SESSION['UserID'];

    // get ban from db
    $query = $conn->prepare("SELECT * FROM bans WHERE receiver = ?");
    $query->execute([$id]);
    return $query->fetch();
  }
}