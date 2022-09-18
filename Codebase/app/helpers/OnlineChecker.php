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
        echo '<div class="online-badge profile" style="float: right">online</div>';
        return;
      }
      echo '<div class="online-badge" style="float: right">online</div>';
      return;
    } else {
      if ($profile != false) {
        echo '<div class="offline-badge profile" style="float: right">offline</div>';
        return;
      }
      echo '<div class="offline-badge" style="float: right">offline</div>';
      return;
    }
  }
}