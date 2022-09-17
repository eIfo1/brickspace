<?php

function UserAuthenticated() {
  if(@$_SESSION['UserAuthenticated']) {
    return true;
  }
  return false;
}
function RequireGuest() {
  if(UserAuthenticated()) {
    header('location: /dashboard');
    exit();
  }
}

function UserAdmin($admin) {
  if($admin != 0 && $admin != 1 && $admin != 2) {
    return true;
  } else {
    return false;
  }
}

function RequireAuthentication() {
  if(!UserAuthenticated()) {
    header('location: /');
    exit();
  }
}

function UpdateUser($pdo)
{
  // update user_upated field in users table to current timestamp WITHOUT NOW()
  $statement = $pdo->prepare("UPDATE users SET user_updated = CURRENT_TIMESTAMP WHERE user_id = :user_id");
  $statement->execute(array(':user_id' => $_SESSION['UserID']));
}