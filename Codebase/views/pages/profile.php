<?php

use brickspace\controller\auth\BanController;
use brickspace\middleware\Auth;
use brickspace\helpers\OnlineChecker;
use brickspace\helpers\Time;

if (!isset($username) && !Auth::Auth()) {
  header('location: /');
  die;
} else {
  if ($_SERVER['REQUEST_URI'] == '/user/profile') {
    $username = $_SESSION['Username'];
  }
  $name = $username;
}
$statement = $conn->prepare("SELECT * FROM users WHERE user_name = :username");
$statement->bindParam(':username', $username, PDO::PARAM_STR);
$statement->execute();
$result = $statement->fetch();
if (!$result) {
  header('location: /user/profile');
  exit();
}
$ban = BanController::Get($conn, $result['user_id']);

?>
<div class="grid-x">
  <div class="cell shrink">
    <nav aria-label="You are here:" role="navigation">
      <ul class="breadcrumbs">
        <li><a href="/users">Users</a></li>
        <li>Profile</li>
        <li>
          <a href="/user/profile/<?php echo $result['user_name']; ?>">
            <?php echo $result['user_name']; ?>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</div>
<div class="grid-x grid-margin-x">
  <div class="cell large-3 small-12">
    <div class="card show-for-large">
      <span class="status">
        <i class="fa fa-quote-left text-secondary"></i>
        <p style="display: inline-block; margin: 0; font-weight: 600">
          <?php
          echo $result['user_status'];
          ?>
        </p>
        <i class="fa fa-quote-right text-secondary"></i>
      </span>
    </div>
    <div class="card">
      <span>
        <?php echo $result['user_name']; ?>
      </span>
      <br>
      <img src="/cdn/img/avatar/<?php echo $result['avatar_link'] ?>.png" alt="Avatar" style="padding: 12px;">
      <?php
      if ($result['user_id'] != @$_SESSION['UserID'] && Auth::Auth()) {
      ?>
        <div class="divider"></div>
        <div class="grid-x">
          <div class="cell auto text-center">
            <button class="button"><i class="fa fa-user-plus"></i></button>
            <button class="button">
              <i class="fa fa-envelope"></i>
            </button>
            <button class="button">
              <i class="fas fa-exchange-alt"></i>
            </button>
          </div>
        </div>
      <?php
      }
      ?>
    </div>
    <?php
    if (!empty($result['user_bio'])) {
    ?>
      <h4>
        About Me
      </h4>
      <div class="card">
        <p>
          <?php
          echo $result['user_bio'];
          ?>
        </p>
      </div>
    <?php
    }
    ?>
    <h4>
      Statistics
    </h4>
    <div class="card">
      <label>

        <?php
        if (OnlineChecker::check($result['user_updated']) == false) {
        ?>
          <i class="fa fa-clock"></i>
          <strong>Last Online:</strong>
          <small><?php echo Time::Elapsed($result['user_updated']); ?></small>
        <?php
        } else {
        ?>
          <i class="fa fa-clock"></i>
          <strong>Last Online:</strong>
          <strong style="color: var(--green);">
            Currently Online
          </strong>
        <?php
        }
        ?>

      </label>
      <label>
        <div class="fa fa-calendar"></div>
        <strong>Registered:</strong> <small><?php echo Time::DateTime($result['user_created']); ?></small>
      </label>
    </div>
  </div>
  <div class="cell large-6 small-12">
    <?php
    if ($ban) {
    ?>
      <div class="secondary alert">
        This user is banned.
      </div>
    <?php
    }
    ?>
    <div class="card">
      <h1>Profile Wall</h1>
      <p>Want to leave a comment for a user? Leave it here.</p>
    </div>
  </div>
</div>