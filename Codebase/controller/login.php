<?php 

if(!is_csrf_valid()) {
  $_SESSION['error'] = "CSRF token invalid!";
  header('location: /login');
  exit();
}

include("{$_SERVER['DOCUMENT_ROOT']}/config/config.php");

$username = $_POST['username'];
$password = $_POST['password'];

if (empty($username) || empty($password)) {
  $_SESSION["error"] = "Please fill in all fields!";
  header("location: /login");
  exit();
}

$statement = $conn->prepare("SELECT * FROM users WHERE user_name = :username");
$statement->execute(array(':username' => $username));
$result = $statement->fetch();
if (!empty($result)) {
  // check password
  if (password_verify($password, $result['user_password'])) {
    $_SESSION["UserAuthenticated"] = "true";
    $_SESSION['UserID'] = $result['user_id'];
    $_SESSION['Username'] = $result['user_name'];
    $_SESSION['UserEmail'] = $result['user_email'];
    $_SESSION['UserIP'] = $_SERVER['REMOTE_ADDR'];
    $_SESSION['Theme'] = $result['user_theme'];
    $_SESSION['note'] = "Welcome back, " . $_SESSION['Username'] . "!";
    header("location: /dashboard/");
    exit();
  } else {
    $_SESSION['error'] = "Invalid username or password.";
    header("location: /login/");
    exit();
  }
} else {
  $_SESSION['error'] = "Invalid username or password.";
  header("location: /login/");
  exit();
}