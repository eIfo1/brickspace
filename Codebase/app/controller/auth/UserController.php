<?php 

namespace brickspace\controller\auth;

use brickspace\middleware\Auth;
use FFI\Exception;

class UserController {
  public static function Currency($conn) {
    if(Auth::Auth()) {
      $currency = $conn->prepare("SELECT cubes FROM users WHERE user_id=?");
      $currency->execute([$_SESSION['UserID']]);
      $currency = $currency->fetch();
      return $currency['cubes'];
    }
  }

  public static function Payout($conn) {
    if (Auth::Auth()) {
      $payout = $conn->prepare("SELECT last_payout FROM users WHERE user_id=?");
      $payout->execute([$_SESSION['UserID']]);
      $payout = $payout->fetch();

      if(time() - strtotime($payout['last_payout']) > 60*60*24) {
        $c = $conn->prepare("UPDATE users SET cubes = cubes + 15 WHERE user_id=?");
        $c->execute([$_SESSION['UserID']]);
        $c = $c->fetch();

        $c = $conn->prepare("UPDATE users SET last_payout = NOW() WHERE user_id=?");
        $c->execute([$_SESSION['UserID']]);
      }
    }
  }

  public static function Avatar($conn) {
    if (Auth::Auth()) {
      $a = $conn->prepare("SELECT * FROM avatar WHERE user_id=?");
      $a->execute([$_SESSION['UserID']]);
      $a = $a->fetch();
      if(!$a) {
        $statement = $conn->prepare("INSERT into avatar (user_id) VALUES (:id)");
        $statement->execute(array(':id' => $_SESSION['UserID']));
        $a = $conn->prepare("SELECT * FROM avatar WHERE user_id=?");
        $a->execute([$_SESSION['UserID']]);
        $a = $a->fetch();
      }
      return $a;
    }
  }
  public static function Edit_Avatar() {
    if (Auth::Auth()) {
      include($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
      $a = $conn->prepare("UPDATE avatar SET head_color = ?, left_leg_color = ?, right_leg_color = ?, right_arm_color = ?, left_arm_color = ?, torso_color = ? WHERE user_id=?");
      $a->execute([$_POST['head_color'], $_POST['left_leg_color'], $_POST['right_leg_color'], $_POST['right_arm_color'], $_POST['left_arm_color'], $_POST['torso_color'], $_SESSION['UserID']]);
    }
  }

  public static function Avatar_Change_Color($limb, $hex) {
    include($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
    $limbs = [
      "head",
      "torso",
      "right_arm",
      "left_arm",
      "right_leg",
      "left_leg"
    ];

    if (ctype_xdigit($hex)) {
      if (in_array($limb, $limbs)) {
        $c = $conn->prepare("UPDATE avatar SET " . $limb . "_color = ? WHERE user_id = ?");
        $c->execute([$hex, $_SESSION['UserID']]);
        return;
        throw new Exception("Error updating");
      }
      throw new Exception("Invalid limb");
    }
    throw new Exception("Invalid hex color");
  }
}