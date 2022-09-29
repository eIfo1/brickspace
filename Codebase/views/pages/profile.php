<?php

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
      if(!empty($result['user_bio'])) {
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
  </div>
</div>