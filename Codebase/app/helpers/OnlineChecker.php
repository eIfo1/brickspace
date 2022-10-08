<?php 

namespace brickspace\helpers;

class OnlineChecker {
  private static function check($timestamp) {
    if (strtotime($timestamp) > strtotime("-120 seconds")) {
      return true;
    }
    return false;
  }

  public static function onlineLabel($timestamp, $profile = false) {
    if(OnlineChecker::check($timestamp)) {
      if($profile != false) {
        echo '<span class="online label">online</span>';
        return;
      }
      echo '<span class="online label" style="float: right">online</span>';
      return;
    } else {
      if ($profile != false) {
        echo '<span class="offline label">offline</span>';
        return;
      }
      echo '<span class="offline label" style="float: right">offline</span>';
      return;
    }
  }
}