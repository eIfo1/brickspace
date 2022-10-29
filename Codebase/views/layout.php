<?php
ob_start();
$conn = '';
$name = '';
include("$_SERVER[DOCUMENT_ROOT]/config/config.php");

use brickspace\middleware\Auth;
use brickspace\controller\admin\AlertController;
use brickspace\controller\auth\BanController;
use brickspace\controller\auth\UserController;
use brickspace\controller\auth\NotificationController;
use brickspace\controller\MaintenanceController;
use brickspace\controller\UsersController;
use brickspace\utils\Toast;
use brickspace\helpers\NumberFormatter;

if (Auth::Auth()) {
  Auth::UpdateUser($conn);
  // if banned redirect
  BanController::Redirect($conn);
  MaintenanceController::Check($conn);
  $u = UsersController::GetByID($conn, $_SESSION['UserID']);
  UserController::Payout($conn);
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

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat" rel="stylesheet">


  <!-- css -->
  <link rel="stylesheet" href="/cdn/css/style.css">
  <link rel="stylesheet" href="/cdn/css/christmas.css">

  <!-- js -->

  <script src="/cdn/js/brickspace.js" defer></script>

  <style>
    .top-bar input {
      background: #444852;
      border: 1px solid transparent;
      width: 100%;
      max-width: 100%;
      margin: 0 auto;
      display: block;
      height: auto;
      box-shadow: none;
      border-radius: 4px;
      padding: 5px 25px;
      color: white;
      font-size: 17px;
    }

    .menu-logo {
      width: 200px !important;
      margin-left: 0.4375rem !important;
      margin-right: 0.9375rem !important;
    }
  </style>


  <!-- jquery -->
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
  <link rel="icon" href="/cdn/img/favicon.png" type="image/x-icon">
</head>

<body>
  <div class="snowflakes" aria-hidden="true">
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
    <div class="snowflake"></div>
  </div>
  <div class="site-wrap">
    <div class="top-bar">
      <div class="top-bar-left">
        <div class="grid-x align-middle grid-margin-x">
          <div class="shrink cell menu-logo show-for-large">
            <a href="/" class="brand-text">
              BrickSpace
            </a>
          </div>
          <div class="cell hide-for-large medium-12">
            <a href="/" class="brand-text">
              BrickSpace
            </a>
            <div class="divider"></div>
          </div>
          <div class="auto cell no-margin">
            <input type="text" placeholder="Search" id="search">
          </div>
          <div class="hide-for-large divider"></div>
          <div class="shrink cell right">
            <?php
            if (Auth::Auth()) {
            ?>
              <div class="info">
                <a href="/account/currency">
                  <i class="fa fa-cubes"></i>
                  <?php echo NumberFormatter::Format(UserController::Currency($conn)); ?>
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
                <a href="/account/customize">
                  <i class="fa fa-user-edit"></i>
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
                <div class="sidebar-text-profile">
                  <a href="/user/profile">
                    <img src="/cdn/img/avatar/thumbnail/<?php echo $u['avatar_link']; ?>.png?<?php echo rand(1, 500) ?>" alt="avatar" class="avatar_thumbnail">
                    <?php echo $_SESSION['Username'] ?>
                  </a>
                </div>
                <li>
                  <a href="/dashboard">
                    <i class="fa fa-home"></i>Dashboard
                  </a>
                </li>
              <?php
              } else {
              ?>
                <div class="sidebar-text">
                  Actions
                </div>
                <li>
                  <a href="/login">
                    <i class="fas fa-sign-in-alt"></i>Login
                  </a>
                </li>
                <li>
                  <a href="/sign-up">
                    <i class="fas fa-user-plus"></i>Sign-Up
                  </a>
                </li>
                <div class="sidebar-text">
                  Links
                </div>
                <li>
                  <a href="/">
                    <i class="fa fa-home"></i>Home
                  </a>
                </li>
              <?php
              }
              ?>
              <li>
                <a href="/forum">
                  <i class="fa fa-cloud"></i>Forum
                </a>
              </li>
              <li>
                <a href="/shop">
                  <i class="fa fa-shopping-cart"></i>Shop
                </a>
              </li>
              <li>
                <a href="/users">
                  <i class="fa fa-users"></i>Users
                </a>
              </li>
              <li>
                <a href="/updates">
                  <i class="fa fa-bullhorn"></i>Updates
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
                  <div class="divider"></div>
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
                <div class="divider"></div>
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
                  <a href="/account/customize">
                    <i class="fa fa-user-edit"></i>Customize
                  </a>
                </li>
                <li>
                  <a href="/account/friends/requests">
                    <i class="fa fa-users"></i>Friends
                  </a>
                </li>
                <li>
                  <a href="/account/currency">
                    <i class="fa fa-money-check"></i>Currency
                  </a>
                </li>
                <li>
                  <a href="/">
                    <i class="fa fa-cog"></i>Settings
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
        ?>
        <div class="content">
          <?php
          include($child_view);
          ?>
        </div>
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
                <li><a href="/shop">Shop</a></li>
                <li><a href="/forum">Forum</a></li>
                <li><a href="/account/customize">Customize</a></li>
              </ul>
            </div>
            <div class="large-2 large-offset-1 medium-3 medium-offset-0 small-4 small-offset-1 cell">
              <div class="footer-title">ABOUT</div>
              <ul class="footer-links">
                <li><a href="/site/terms-of-service">Terms of Service</a></li>
                <li><a href="/privacy-policy">Privacy Policy</a></li>
                <li><a href="/about-us">About Us</a></li>
                <li><a href="/blog">Blog</a></li>
              </ul>
            </div>
            <div class="large-2 large-offset-1 medium-3 medium-offset-0 small-4 small-offset-1 cell">
              <div class="footer-title">SUPPORT</div>
              <ul class="footer-links">
                <li><a href="/site/donate">Donate</a></li>
                <li><a href="/site/support">Help Center</a></li>
                <li><a href="/site/hiring-center">Work With Us</a></li>
                <li><a href="/site/contact">Contact Us</a></li>
              </ul>
            </div>
            <div class="large-2 large-offset-1 medium-3 medium-offset-0 small-4 small-offset-1 cell">
              <div class="footer-title">COMMUNITY</div>
              <ul class="footer-links">
                <li><a href="/upgrade">Forum</a></li>
                <li><a href="https://discord.gg/YNXCx6Ph94">Discord</a></li>
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
  <script type="text/javascript">
    $(function() {
      // this will get the full URL at the address bar
      const url = window.location.href;

      // passes on every "a" tag
      $(".side-bar a").each(function() {
        // checks if it's the same on the address bar
        if (url === (this.href)) {
          $(this).closest("a").addClass("active");
          //for making parent of submenu active
          $(this).closest("a").parent().parent().addClass("active");
        }
      });
    });
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