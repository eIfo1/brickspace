<?php
ob_start();
include("$_SERVER[DOCUMENT_ROOT]/config/config.php");

use brickspace\middleware\Auth;
use brickspace\controller\admin\AlertController;
use brickspace\controller\auth\BanController;
use brickspace\controller\auth\UserController;
use brickspace\controller\auth\NotificationController;
use brickspace\utils\Toast;

if (Auth::Auth()) {
  Auth::UpdateUser($conn);
  BanController::Redirect($conn);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

  <!-- foundation -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/foundation-sites@6.7.5/dist/css/foundation.min.css" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/motion-ui/1.1.1/motion-ui.min.css">


  <!-- css -->
  <link rel="stylesheet" href="/cdn/css/style.css">

  <!-- js -->

  <script src="/cdn/js/brickspace.js" defer></script>


  <!-- jquery -->
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
  <link rel="icon" href="/cdn/img/favicon.png" type="image/x-icon">
</head>

<body>
  <div class="site-wrap">
    <div class="top-bar">
      <div class="top-bar-left">
        <div class="grid-x align-middle grid-margin-x">
          <div class="shrink cell">
            <a href="/" class="brand-text">
              BrickSpace
            </a>
          </div>
          <div class="auto cell">

          </div>
          <div class="shrink cell right">
            <?php
            if (Auth::Auth()) {
            ?>
              <div class="info">
                <a href="/account/currency">
                  <i class="fa fa-cubes"></i>
                  <?php echo UserController::Currency($conn); ?>
                </a>
                <a href="/account/friends/requests">
                  <i class="fa fa-user-plus"></i>
                  0
                </a>
                <a href="/account/notifications">
                  <i class="fa fa-bell"></i>
                  <?php echo NotificationController::Amount($conn); ?>
                </a>
                <a href="/account/inbox">
                  <i class="fa fa-envelope"></i>
                  0
                </a>
              </div>
              <div class="info">
                <a href="/account/settings">
                  <i class="fa fa-cog"></i>
                </a>
              </div>
              <form action="/logout" method="post" style="display: inline-block">
                <?php set_csrf() ?>
                <button type="submit" class="logout-button">
                  LOG-OUT
                </button>
              </form>
            <?php
            } else {
            ?>
              <button type="submit" class="sign-in-button" onclick="window.location.assign('/login');">
                LOGIN
              </button>
              <button type="submit" class="sign-up-button" onclick="window.location.assign('/sign-up');">
                SIGN-UP
              </button>
            <?php
            }
            ?>
          </div>
        </div>
      </div>
    </div>
    <div class="top-bar-push"></div>
    <div class="grid-x grid-margin-x">
      <div class="sidebar-shrink shrink cell no-margin">
        <div class="side-bar">
          <div class="sidebar-inner">
            <ul>
              <?php
              if (Auth::Auth()) {
              ?>
                <div class="sidebar-text">
                  <a href="/user/profile">
                    <i class="fa fa-user"></i>
                    <?php echo $_SESSION['Username'] ?>
                  </a>
                </div>
              <?php
              } else {
              ?>
                <div class="sidebar-text">
                  Links
                </div>
              <?php
              }
              ?>
              <li>
                <a href="/">
                  <i class="fa fa-home"></i>Home
                </a>
              </li>
              <li>
                <a href="/forum">
                  <i class="fa fa-cloud"></i>Forum
                </a>
              </li>
              <li>
                <a href="/market">
                  <i class="fa fa-shopping-cart"></i>Market
                </a>
              </li>
              <li>
                <a href="/users">
                  <i class="fa fa-users"></i>Users
                </a>
              </li>
              <li>
                <a href="/blog">
                  <i class="fa fa-rss"></i>Blog
                </a>
              </li>
              <?php
              if (Auth::Auth()) {
              ?>
                <li>
                  <a href="/user/profile">
                    <i class="fa fa-user"></i>Profile
                  </a>
                </li>
                <?php
                if (Auth::Admin()) {
                ?>
                  <div class="sidebar-text">
                    ADMIN
                  </div>
                  <li>
                    <a href="/admin">
                      <i class="fa fa-cog"></i>Admin
                    </a>
                  </li>
                <?php
                }
                ?>
                <div class="sidebar-text">
                  ACCOUNT
                </div>
                <li>
                  <a href="/account/inbox">
                    <i class="fa fa-envelope"></i>Inbox
                    <div class="label right">3</div>
                  </a>
                </li>
                <li>
                  <a href="/">
                    <i class="fa fa-cog"></i>Settings
                  </a>
                </li>
                <li>
                  <a href="/account/currency">
                    <i class="fa fa-money-check"></i>Currency
                  </a>
                </li>
              <?php
              }
              ?>
            </ul>
          </div>
        </div>
      </div>
      <div class="auto cell no-margin">
        <?php
        Toast::Handle();
        AlertController::Display($conn);
        include($child_view);
        ?>
      </div>
    </div>
  </div>
  </div>
  <div class="site-footer">
    <div class="grid-x grid-margin-x">
      <div class="sidebar-shrink shrink cell no-margin"></div>
      <div class="auto cell no-margin">
        <div class="grid-container">
          <div class="grid-x grid-margin-x">
            <div class="large-2 large-offset-1 medium-3 medium-offset-0 small-4 small-offset-1 cell">
              <div class="footer-title">NAVIGATE</div>
              <ul class="footer-links">
                <li><a href="/">Home</a></li>
                <li><a href="/market">Store</a></li>
                <li><a href="/forum">Forum</a></li>
                <li><a href="/upgrade">Upgrade</a></li>
              </ul>
            </div>
            <div class="large-2 large-offset-1 medium-3 medium-offset-0 small-4 small-offset-1 cell">
              <div class="footer-title">ABOUT</div>
              <ul class="footer-links">
                <li><a href="/terms-of-service">Terms of Service</a></li>
                <li><a href="/privacy-policy">Privacy Policy</a></li>
                <li><a href="/about">About Us</a></li>
                <li><a href="/blog">Blog</a></li>
              </ul>
            </div>
            <div class="large-2 large-offset-1 medium-3 medium-offset-0 small-4 small-offset-1 cell">
              <div class="footer-title">SUPPORT</div>
              <ul class="footer-links">
                <li><a href="/support">Support</a></li>
                <li><a href="/market">Help Center</a></li>
                <li><a href="/forum">Work With Us</a></li>
                <li><a href="/upgrade">Upgrade</a></li>
              </ul>
            </div>
            <div class="large-2 large-offset-1 medium-3 medium-offset-0 small-4 small-offset-1 cell">
              <div class="footer-title">COMMUNITY</div>
              <ul class="footer-links">
                <li><a href="/upgrade">Forum</a></li>
                <li><a href="/">Discord</a></li>
                <li><a href="/market">Twitter</a></li>
                <li><a href="/forum">Youtube</a></li>
              </ul>
            </div>
          </div>
          <div class="footer-text">
            &copy; BrickSpace 2022
          </div>
        </div>
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
<!-- scripts -->
<!-- title -->
<title>
  <?php
  echo $name;
  ?> // BrickSpace
</title>

</html>