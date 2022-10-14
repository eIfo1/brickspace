<?php 

namespace brickspace\helpers;

class OnlineChecker {
  public static function check($timestamp) {
    if (strtotime($timestamp) > strtotime("-120 seconds")) {
      return true;
    }
    return false;
  }

  public static function onlineLabel($timestamp, $profile = false) {
    if(OnlineChecker::check($timestamp)) {
      if($profile != false) {
        echo '<span class="online label right">online</span>';
        return;
      }
      echo '<span class="online label right">online</span>';
      return;
    } else {
      if ($profile != false) {
        echo '<span class="offline label right">offline</span>';
        return;
      }
      echo '<span class="offline label right">offline</span>';
      return;
    }
  }
}