<?php
include("$_SERVER[DOCUMENT_ROOT]/config/config.php");
include("$_SERVER[DOCUMENT_ROOT]/app/functions/functions.php");

use brickspace\helpers\Time;
use brickspace\controller\auth\WallController;
$wall = WallController::GetPosts();
  foreach ($wall as $post) {
    $user = GetUserByID($conn, $post['wall_creator']);
?>
    <div class="card">
      <div class="ellipsis">
        <a href="/user/profile/<?php echo $user['user_name']; ?>">
          <?php
          echo $user['user_name'];
          ?>
        </a> - 
        <p style="display: inline-block">
          <?php
          echo Time::Elapsed($post['wall_created']);
          ?>
        </p>
      </div>
      <p>
        <?php
        echo $post['wall_message'];
        ?>
      </p>
    </div>
<?php
  }
?>