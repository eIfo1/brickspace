<?php
$message = $_POST['message'];

include($_SERVER['DOCUMENT_ROOT'] . "/functions/functions.php");
include($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");

if (!UserAuthenticated()) {
  $_SESSION['error'] = "You must be logged in to post on the wall!";
  header("Location: /login");
  exit();
}

$creator = $_SESSION['UserID'];

if (empty($message)) {
  $_SESSION['error'] = 'The wall message is empty!';
  header('location: /dashboard/');
  exit();
}

if(strlen($message) <= 3 || strlen($message) >= 250) {
  $_SESSION['error'] = 'The wall message is either too long or too short!';
  header('location: /dashboard/');
  exit();
}

// insert 
$statement = $conn->prepare("INSERT INTO wall (wall_message, wall_creator, wall_created) VALUES (:message, :creator, NOW())");
$statement->execute(array(':message' => $message, ':creator' => $creator));

$_SESSION['note'] = 'Message posted!';
header('location: /dashboard/');
exit();