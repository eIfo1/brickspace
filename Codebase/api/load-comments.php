<?php
include("$_SERVER[DOCUMENT_ROOT]/config/config.php");

use brickspace\helpers\Time;
use brickspace\controller\auth\WallController;
use brickspace\controller\UsersController;

$wall = WallController::GetPosts($conn);

if(!$wall) {
  ?>
  <div class="card">
    <strong>No posts! Make one below!</strong>
  </div>
  <?php 
}

foreach ($wall as $post) {
  $user = UsersController::GetByID($conn, $post['wall_creator']);
?>
    <div class="grid-x grid-margin-x">
      <div class="cell small-12 large-2">
        <div class="frame">
          <a href="/user/profile/<?php echo $user['user_name'];?>">
            <img src="/cdn/img/avatar/thumbnail/<?php echo md5($user['user_id']);  ?>.png" alt="elfo's avatar" class="normal_thumbnail" style="text-align: center;">
          </a>
        </div>
      </div>
      <div class="cell auto">
        <div class="ellipsis">
          <a href="/user/profile/<?php echo $user['user_name']; ?>">
            <?php
            echo $user['user_name'];
            ?>
          </a> -
          <p style="display: inline-block; margin: 0;">
            <?php
            echo Time::Elapsed($post['wall_created']);
            ?>
          </p>
          <p>
            <?php
            echo $post['wall_message'];
            ?>
          </p>
        </div>
      </div>
    </div>
<?php
}
?>