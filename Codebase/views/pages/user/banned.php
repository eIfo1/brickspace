<?php

use brickspace\controller\auth\BanController;

$name = "Banned";
$ban = BanController::Get($conn);

if(!$ban) {
  header('location: /dashboard');
  die;
}
?>

<div class="grid-x grid-margin-x">
  <div class="cell large-3 small-12"></div>
  <div class="cell auto">
    <div class="card">
      <h1>
        <?php
        if ($ban['until'] != null) {
          echo "Banned";
        } else {
          echo "Account Deleted";
        }
        ?>
      </h1>
      <p>
        Our content monitors have determined that your behaviour here at BrickSpace has been in violation of our Terms of Service.
      </p>
      <br>
      <p><strong>Reason: </strong><?php echo $ban['reason']; ?></p>
      <p><strong>Moderator Note: </strong><?php echo $ban['note']; ?></p>
      <?php
      if ($ban['until'] != null) {
      ?>
        <label for="time">
          <strong>Reactivation Time:</strong>
          <?php
  
          echo $ban['until'];
  
          ?>
        </label>
      <?php
      }
      ?>
      <p>
        If you wish to appeal, please issue a request in our <i>Discord server</i> through the <i>#ban-appeals</i> channel.
      </p>
      <form action="/logout" method="post" style="display: inline-block">
        <?php set_csrf() ?>
        <button type="submit" class="logout-button">
          LOG-OUT
        </button>
      </form>
    </div>
  </div>
  <div class="cell large-3 small-12"></div>
</div>