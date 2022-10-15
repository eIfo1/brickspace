<?php
ob_start();
include("$_SERVER[DOCUMENT_ROOT]/config/config.php");

use brickspace\middleware\Auth;
use brickspace\controller\admin\AlertController;
use brickspace\controller\auth\BanController;
use brickspace\controller\auth\UserController;
use brickspace\controller\auth\NotificationController;
use brickspace\controller\UsersController;
use brickspace\utils\Toast;

Auth::Deny();

$c = UsersController::Count($conn);


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="keywords" content="game, sandbox, 3d sandbox, 3d avatars, forums">
  <meta name="description" content="A 3D sandbox community with 4+ users. Join a community of players that are foruming, shopping, customizing, and so much more.">
  <meta name="author" content="gilfoyle">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

  <!-- foundation -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/foundation-sites@6.7.5/dist/css/foundation.min.css" crossorigin="anonymous">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&amp;display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">


  <!-- css -->
  <link rel="stylesheet" href="/cdn/css/style.css">

  <style>
    body {
      background: rgb(13, 71, 122);
      height: auto;
    }

    .card {
      background: rgb(30, 98, 154);
      border: none;
    }

    input {
      background: rgb(13, 71, 122) !important;
      border: none !important;
      border-radius: 5px !important;
    }

    * {
      font-family: quicksand !important;
    }

    .site-margin {
      margin-top: 12em;
    }
  </style>

  <!-- js -->

  <script src="/cdn/js/brickspace.js" defer></script>


  <!-- jquery -->
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
  <link rel="icon" href="/cdn/img/favicon.png" type="image/x-icon">
</head>

<body>
  <div class="site-margin"></div>
  <div class="grid-x grid-margin-x">
    <div class="cell large-2 small-12"></div>
    <div class="cell large-4 small-12">
      <div class="card">
        <h2>
          Welcome to BrickSpace!
        </h2>
        <p>
          BrickSpace is a 3D sandbox community with <strong><?php echo $c ?>+ users</strong>. Join a community of players that are foruming, shopping, customizing, and so much more.
        </p>
        <img src="/cdn/img/landing.png" alt="BrickSpace Dashboard" style="border-radius: 5px;">
        <small class="text-center">
          A small look into BrickSpace's website.
        </small>
      </div>
    </div>
    <div class="cell large-4 small-12">
      <div class="card">
        <h4 class="text-center">
          Get started for free!
        </h4>
        <form action="/sign-up" method="POST">
          <input class="input-field" type="text" placeholder="Username" name="username" required>
          <input class="input-field" type="email" placeholder="Email" name="email" required>
          <input class="input-field" type="password" placeholder="Password" name="password" required>
          <input class="input-field" type="password" placeholder="Password Repeat" name="password_repeat" required>
          <?php
          set_csrf();
          ?>
          <button class="button" style="width: 100%;">
            Sign-Up
          </button>
        </form>
        <small>
          Already have an account? <a href="/login">Login!</a>
        </small>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/foundation-sites@6.7.5/dist/js/foundation.min.js" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function() {
      $(document).foundation();
    })
  </script>
</body>

</html>