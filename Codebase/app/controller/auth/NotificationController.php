<?php 

namespace brickspace\controller\auth;

use brickspace\middleware\Auth;

class NotificationController {
  public static function Number($conn) {
    Auth::Require();

    // get number of notification
  }
  
  public static function GetAll($conn, $page) {
    Auth::Require();

    // get all notifications
  }

  public static function Get($conn, $id) {
    Auth::Require();

    // get specific notification
  }
  public static function Read($conn) {
    Auth::Require();

    // TODO: make sure notification user is setting as read actually belongs to the user

    $notification = NotificationController::Get($conn, $_POST['id']);

    // set notification as read
  }

  public static function Delete($conn) {
    Auth::Require();

    // TODO: make sure notification user is deleting actually belongs to the user
    // TODO: if the notification is global then don't actually delete

    $notification = NotificationController::Get($conn, $_POST['id']);

    // delete notification
  }

  public static function Create($conn, $notification, $recipient) {
    Auth::Require();

    //  create notification
  }
} 