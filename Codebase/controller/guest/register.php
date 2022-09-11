<?php

if (!is_csrf_valid()) {
  $_SESSION['error'] = "CSRF token invalid!";
  header('location: /sign-up');
  exit();
}

include("{$_SERVER['DOCUMENT_ROOT']}/config/config.php");

$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$passwordRepeat = $_POST["password_repeat"];

// TODO make this all one function
if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
  $_SESSION["error"] = "Please fill in all fields";
  header("location: /sign-up");
  exit();
}
if (!preg_match("/^[a-zA-Z0-9_]*$/", $username)) {
  $_SESSION["error"] = "Username can only contain letters, numbers, and underscores.";
  header("location: /sign-up");
  exit();
}
if (strlen($username) > 20 || strlen($username) < 3) {
  $_SESSION["error"] = "Username must be between 3 and 20 characters.";
  header("location: /sign-up");
  exit();
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $_SESSION["error"] = "Invalid email.";
  header("location: /sign-up");
  exit();
}
if (strlen($password) < 8 || strlen($password) > 50) {
  $_SESSION["error"] = "Password must be between 8 and 50 characters.";
  header("location: /sign-up");
  exit();
}
if ($password != $passwordRepeat) {
  $_SESSION["error"] = "Passwords do not match.";
  header("location: /sign-up");
  exit();
}
$statement = $conn->prepare("SELECT * FROM users WHERE user_name = :username");
$statement->execute(array(':username' => $username));
$result = $statement->fetch();
// if result is not empty, username exists
if (!empty($result)) {
  $_SESSION["error"] = "Username already exists.";
  header("location: /sign-up");
  exit();
}

$statement = $conn->prepare("INSERT INTO users (user_name, user_email, user_password, user_signup_ip, user_ip) VALUES (:username, :email, :password, :ip, :ip)");
// hash password
$password = password_hash($password, PASSWORD_DEFAULT);
$statement->execute(array(':username' => $username, ':email' => $email, ':password' => $password, ':ip' => md5($_SERVER['REMOTE_ADDR'])));
// ANCHOR session variables
session_start();
$_SESSION["UserAuthenticated"] = "true";
$_SESSION['UserID'] = $conn->lastInsertId();
$_SESSION['Username'] = $username;
$_SESSION['UserEmail'] = $email;
$_SESSION['UserIP'] = $_SERVER['REMOTE_ADDR'];
$_SESSION['Theme'] = 0;
$_SESSION['note'] = "Welcome to RobloxClone, " . $_SESSION['Username'] . "!";
header("location: /dashboard/");
exit();
