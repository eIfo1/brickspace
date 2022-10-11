<?php

use brickspace\controller\auth\BanController;
use brickspace\middleware\Auth;
use brickspace\helpers\OnlineChecker;
use brickspace\helpers\Time;

if (!isset($username)) {
  if (Auth::Auth()) {
    $username = $_SESSION['Username'];
    $name = $username;
  } else {
    header('location: /');
    exit();
  }
} else {
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
<div class="grid-x grid-margin-x">
  <div class="cell shrink">
    <div class="card">
      <span>
        <i class="fa fa-quote-left text-secondary"></i>
        <p style="display: inline-block; margin: 0; font-weight: 600">
          <?php
          echo $result['user_status'];
          ?>
        </p>
        <i class="fa fa-quote-right text-secondary"></i>
      </span>
    </div>
  </div>
</div>
  <div class="grid-x grid-margin-x">
    <div class="cell large-4 small-12">
      <div class="card">
        <span>
          <?php echo $result['user_name']; ?> <?php
                                              OnlineChecker::onlineLabel($result['user_updated'], true);
                                              ?>
        </span>
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
          <i class="fa fa-clock"></i>
          <strong>Last Online:</strong> <?php echo Time::Elapsed($result['user_updated']); ?>
        </label>
        <label>
          <div class="fa fa-calendar"></div>
          <strong>Registered:</strong> <?php echo Time::DateTime($result['user_created']); ?>
        </label>
      </div>
      <?php
      if (!Auth::Admin()) {
      ?>
        <div class="card">
          <h1 class="center">
            Moderation Actions
          </h1>
          <div class="admin-buttons">
            <div class="tooltip">
              <a href="/moderation/ban/user/<?php echo $result['user_name'] ?>"><i class="fa fa-hammer"></i></a>
              <div class="text">
                Ban <?php echo $result['user_name'] ?>?
              </div>
            </div>
            <div class="tooltip">
              <a href="/moderation/logs/user/<?php echo $result['user_name'] ?>"><i class="fa fa-clipboard"></i></a>
              <div class="text">
                View <?php echo $result['user_name'] ?>'s Logs?
              </div>
            </div>
            <div class="tooltip">
              <a href="/moderation/logs/user/<?php echo $result['user_name'] ?>"><i class="fa fa-user-plus"></i></a>
              <div class="text">
                Alternate Account Detection
              </div>
            </div>
            <div class="tooltip">
              <a href="/moderation/logs/user/<?php echo $result['user_name'] ?>"><i class="fa fa-soap"></i></a>
              <div class="text">
                Scrub
              </div>
            </div>
          </div>
        </div>
      <?php
      }
      ?>
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