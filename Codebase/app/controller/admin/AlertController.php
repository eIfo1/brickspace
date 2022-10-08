<?php

namespace brickspace\controller\admin;

use brickspace\helpers\Purify;
use brickspace\middleware\Auth;



class AlertController
{
  public static function Get($conn)
  {
    $sql = "SELECT * FROM site_settings WHERE id = 1";
    $result = $conn->query($sql);
    $row = $result->fetch();
    // purify
    $row['alert_link'] = Purify::purify($row['alert_link']);
    $row['alert_text'] = Purify::purify($row['alert_text']);
    // assign
    $alert['link'] = $row['alert_link'];
    $alert['text'] = $row['alert_text'];
    $alert['bool'] = $row['alert'];
    return $alert;
  }

  public static function Post()
  {
    include($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
    Auth::RequireAdmin();
    if (!is_csrf_valid()) {
      header('location: /admin/alert');
      exit();
    }

    $link = $_POST['alert_link'];
    $text = $_POST['alert_text'];
    $bool = $_POST['alert_bool'];

    if (empty($text) && $bool != 0) {
      $_SESSION['error'] = "Please add some text.";
      header('location: /admin/alert');
      exit();
    }

    $sql = "UPDATE site_settings SET alert = :alert_bool, alert_text = :alert_text, alert_link = :alert_link WHERE id = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':alert_bool', $bool);
    $stmt->bindParam(':alert_text', $text);
    $stmt->bindParam(':alert_link', $link);
    $stmt->execute();

    $_SESSION['note'] = "Updated Alert Successfully!";
    header('location: /admin/alert');
    exit();
  }

  public static function Display($conn)
  {
    $alert = AlertController::Get($conn);
    if (!$alert) {
      return;
    }
?>
    <div class="site-notification">
      <div class="grid-x align-middle grid-margin-x">
        <div class="shrink cell">
          <i class="fa fa-exclamation-circle"></i>
        </div>
        <div class="auto cell">
          <?php
          if ($alert['bool'] == 1) {
            if ($alert['link'] != "") {
          ?>
              <?php
              echo $alert['text'];
              ?>
              <span>Click <a style="color: #fff; text-decoration: underline;" href="<?php echo $alert['link']; ?>">here</a> to learn more.</span>
            <?php
            } else {
            ?>
              <div class="site-notification">
                <div class="grid-x align-middle grid-margin-x">
                  <div class="shrink cell">
                    <i class="fa fa-exclamation-circle"></i>
                  </div>
                  <div class="auto cell">
                    <?php
                    echo $alert['text'];
                    ?>
                  </div>
                  <div class="shrink cell right">
                    <i class="fa fa-exclamation-circle"></i>
                  </div>
                </div>
              </div>
          <?php
            }
          }
          ?>
        </div>
        <div class="shrink cell right">
          <i class="fa fa-exclamation-circle"></i>
        </div>
      </div>
    </div>
<?php
  }
}
