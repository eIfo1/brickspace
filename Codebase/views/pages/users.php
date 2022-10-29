<?php
$name = "Users";

use brickspace\helpers\OnlineChecker;
use brickspace\middleware\Auth;
use brickspace\controller\UsersController;
use brickspace\helpers\Pagination;

$page = Pagination::Set(@$page);

$result = UsersController::Get($conn, $page, false);
$count = 1;

?>



<div class="grid-x grid-margin-x">
  <div class="cell large-1 small-12">
    <div class="card">
      <a href="/users/staff">
        <button class="button">STAFF</button>
      </a>
    </div>
  </div>
  <div class="cell auto">
    <div class="grid-x grid-margin-x">
      <?php
      $count = UsersController::Display($result);
      ?>
    </div>
    <?php
    echo Pagination::Handle($page, '/users/', $count, 8);
    ?>
  </div>
  <div class="cell large-1 small-12"></div>
</div>