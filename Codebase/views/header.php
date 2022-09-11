<?php
ob_start();
include("$_SERVER[DOCUMENT_ROOT]/config/config.php");
include("$_SERVER[DOCUMENT_ROOT]/functions/functions.php");
if (UserAuthenticated()) {
  UpdateUser($conn);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/cdn/css/style.css" type="text/css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&amp;display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/gh/hung1001/font-awesome-pro@4cac1a6/css/all.css" rel="stylesheet" type="text/css" />
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
</head>

<body>
  <div class="page-container">
    <div class="content-wrap">
      <nav>
        <div class="nav">
          <div class="container">
            <div class="left">
              <span>RobloxClone</span>
              <a href="/">
                <i class="fa fa-home"></i>Home
              </a>
              <a href="/users">
                <i class="fa fa-users"></i>Users
              </a>
              <?php
              // user admin check
              //if(UserAdmin()) {
              ?>
              <a href="/admin">
                <i class="fa fa-cog"></i>Admin
              </a>
              <?php
              //}
              ?>
            </div>
            <div class="right">
              <?php
              if (!UserAuthenticated()) {
              ?>
                <a href="/login">
                  <i class="fa fa-sign-in"></i>Login
                </a>
                <a href="/sign-up">
                  <i class="fa fa-user-plus"></i>Sign-Up
                </a>
              <?php
              } else {
              ?>
                <a href="/logout">
                  <i class="fa fa-sign-out"></i>Logout
                </a>
              <?php
              }
              ?>
            </div>
          </div>
        </div>
        <?php
        if (UserAuthenticated()) {
        ?>
          <div class="secondary-nav">
            <div class="container">
              <div class="left">
                <a href="/user/profile">
                  <i class="fa fa-user"></i>Profile
                </a>
              </div>
            </div>
          </div>
        <?php
        }
        ?>
      </nav>
      <div class="container">