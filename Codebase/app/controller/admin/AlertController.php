<?php

namespace brickspace\controller\admin;
use brickspace\helpers\Purify;



class AlertController {
  public static function Get() {
    include($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
    $sql = "SELECT * FROM site_settings WHERE id = 1";
    $result = $conn->query($sql);
    $row = $result->fetch();
    // purify
    $row['alert_link'] = Purify::purify($row['alert_link']);
    $row['alert_text'] = Purify::purify($row['alert_text']);
    // assign
    $alert['link'] = $row['alert_link'];
    $alert['text'] = $row['alert_text'];
    $alert['bool']= $row['alert'];
    return $alert;
  }

  public static function Post() {
    include($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
    if(!is_csrf_valid()) {
      header('location: /admin/alert');
      exit();
    }

    $link = $_POST['alert_link'];
    $text = $_POST['alert_text'];
    $bool = $_POST['alert_bool'];

    if(empty($text) && $bool != 0) {
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
}