<?php 

namespace brickspace\controller\auth;

class BanController {
  /**
   * Checks if the user exists in the banned table
   */
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


  /**
   * Gets the ban case for the current user
   */
  public static function Get($conn, $id = null) {
    // Get user ID from session
    if($id == null) $id = $_SESSION['UserID'];
    

    // get ban from db
    $query = $conn->prepare("SELECT * FROM bans WHERE receiver = ?");
    $query->execute([$id]);
    return $query->fetch();
  }

  public static function Redirect($conn) {
    if (BanController::Check($conn) == true) {
      if ($_SERVER['REQUEST_URI'] != "/banned") {
        header('location: /banned');
        exit();
      }
    }
  }
}
