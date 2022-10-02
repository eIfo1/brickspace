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

<div class="row">
  <div class="col-4">
    <div class="ellipsis">
      <div class="speech-bubble">
        <?php
        echo $result['user_status'];
        ?>
      </div>
      <br>
      <h2 class="title">
        <?php echo $result['user_name']; ?>
      </h2>
      <?php
      OnlineChecker::onlineLabel($result['user_updated'], true);
      ?>
    </div>
    <?php
    if (!empty($result['user_bio'])) {
    ?>
      <div class="card">
        <h3>
          About Me
        </h3>
        <p>
          <?php
          echo $result['user_bio'];
          ?>
        </p>
      </div>
    <?php
    }
    ?>
    <br>
    <div class="card">
      <label><strong>Last Online:</strong> <?php echo Time::Elapsed($result['user_updated']); ?></label>
      <br>
      <label><strong>User Created:</strong> <?php echo Time::Date($result['user_created']); ?></label>
    </div>
    <?php
    if (Auth::Admin()) {
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
  <div class="col-6">
    <?php 
      if($ban) {
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