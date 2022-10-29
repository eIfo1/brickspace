<?php 

namespace brickspace\controller\auth;

use brickspace\middleware\Auth;

class NotificationController {
  public static function Amount($conn) {
    Auth::Require();

    // get number of notifications
    $query = $conn->prepare("SELECT COUNT(*) FROM notifications WHERE receiver = ?");
    $query->execute([$_SESSION['UserID']]);
    return $query->fetch()['COUNT(*)'];
  }
  
  public static function GetAll($conn, $page) {
    Auth::Require();

    // get all notifications
    $query = $conn->prepare("SELECT * FROM notifications WHERE receiver = ?");
    $query->execute([$_SESSION['UserID']]);
    return $query->fetch();
  }

  public static function Get($conn, $id) {
    Auth::Require();

    // get specific notification
    $query = $conn->prepare("SELECT * FROM notifications WHERE id = ?");
    $query->execute([$id]);
    $result = $query->fetch();
    // check if the notification that is being fetched belongs to the user
    if($result['receiver'] != $_SESSION['UserID']) {
      header('location: /dashboard');
      exit();
    } 
    // return the resultx
    return $result;
  } 
  public static function Read($conn) {
    Auth::Require();

    $notification = NotificationController::Get($conn, $_POST['id']);

    // set notification as read
    if($notification['read'] != 0 || $notification['global'] != 0) {
      // notification is already set as read or notification is global
      header('location: /account/notifications');
      exit();
    }
    // TODO: notification set as read
  }

  public static function Delete($conn) {
    Auth::Require();

    // TODO: make sure notification user is deleting actually belongs to the user

    $notification = NotificationController::Get($conn, $_POST['id']);

    // delete notification
    if ($notification['global'] != 0) {
      //  notification is global
      header('location: /account/notifications');
      exit();
    }
  }

  public static function Create($conn, $notification, $recipient) {
    Auth::Require();

    //  create notification
  }
} 