<?php
ob_start();
include("$_SERVER[DOCUMENT_ROOT]/config/config.php");
include("$_SERVER[DOCUMENT_ROOT]/app/functions/functions.php");

use brickspace\middleware\Auth;

if (Auth::Auth()) {
  Auth::UpdateUser($conn);
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
      <noscript>
        <h1 class="center">
          Hey..
        </h1>
        <p class="center">
          BrickSpace requires JavaScript on some pages to work properly. Without it, performance may be degraded.
        </p>
      </noscript>
      <?php
      $sql = "SELECT * FROM site_settings WHERE id = 1";
      $result = $conn->query($sql);
      $alert = $result->fetch();
      if (!$alert) {
        return;
      }
      if ($alert['alert'] == 1) {
        if ($alert['alert_link'] != "") {
      ?>
          <div class="alert red">
            <div class="row">
              <div class="col-1 no-padding">
                <i class="fas fa-exclamation-triangle"></i>
              </div>
              <div class="col-10 no-padding">
                <?php
                echo $alert['alert_text'];
                ?>
                Click
                <a href="<?php echo $alert['alert_link'] ?>" style="color: var(--text); text-decoration: underline;">here</a> for more info
              </div>
              <div class="col-1 no-padding">
                <i class="fas fa-exclamation-triangle"></i>
              </div>
            </div>
          </div>
        <?php
        } else {
        ?>
          <div class="alert red">
            <div class="row">
              <div class="col-1 no-padding">
                <i class="fas fa-exclamation-triangle"></i>
              </div>
              <div class="col-10 no-padding">
                This is a test alert! Nothing to see here.
              </div>
              <div class="col-1 no-padding">
                <i class="fas fa-exclamation-triangle"></i>
              </div>
            </div>
          </div>
      <?php
        }
      }
      ?>
      <nav>
        <div class="nav">
          <div class="container">
            <div class="left">
              <span>BrickSpace</span>
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
              if (!Auth::Auth()) {
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
                <form action="/logout" method="post">
                  <?php set_csrf() ?>
                  <button type="submit">
                  <i class="fa fa-sign-out"></i>  
                  Logout
                  </button>
                </form>
              <?php
              }
              ?>
            </div>
          </div>
        </div>
        <?php
        if (Auth::Auth()) {
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
        <?php include($child_view); ?>
      </div>
    </div>
    <footer>
      <div class="copyright">
        &copy; 2022 BrickSpace. All Rights Reserved
      </div>
  </div>
  </footer>
  </div>
</body>
<!-- scripts -->
<!-- title -->
<title>
  <?php
  echo $name;
  ?> // BrickSpace
</title>

</html>