<?php 

namespace brickspace\controller\auth;

class FriendController {
  /**
   * Checks if the given item is a friend request
   *
   * @param bool $var The request variable
   * @return bool
   */
  public static function IsRequest($var) {
    if($var == 1) {
      return true;
    }
    return false;
  }

  public static function GetRequest($conn, $receiver) {
    $sender = $_SESSION['UserID'];

    $a = $conn->prepare("SELECT * FROM friends WHERE sender = ? AND receiver = ?");
    $a->execute([$sender, $receiver]);
    $e = $a->fetch();
    return $e;
  }
}