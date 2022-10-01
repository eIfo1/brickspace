<?php

use brickspace\controller\auth\BanController;

$name = "Banned";
$ban = BanController::Get($conn);
?>

<div class="row">
  <div class="col-6 col-center">
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
      <em>
        Our content monitors have determined that your behaviour here at BrickSpace has been in violation of our Terms of Service.
      </em>
      <br>
      <br>
      <p><strong>Reason:</strong> <em><?php echo $ban['reason']; ?></em></p>
      <br>
      <p><strong>Moderator Note:</strong> <em><?php echo $ban['note']; ?></em></p>
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
      <br>
      <p>
        If you wish to appeal, please issue a request in our <em>Discord server</em> through the <em>#ban-appeals</em> channel.
      </p>
    </div>
  </div>
</div>