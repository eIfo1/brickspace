<?php
$name = "Users";


use function CommonMark\Render\HTML;

use brickspace\controller\UsersController;
use brickspace\helpers\OnlineChecker;
use brickspace\helpers\Pagination;
use brickspace\middleware\Auth;

$page = Pagination::Set(@$page);

$result = UsersController::Get($conn, $page, true);
$count = 1;

if (!$result) {
  header('location: /dashboard');
  exit();
}
?>
<div class="grid-x grid-margin-x">
  <div class="cell large-1 small-12">
    <div class="card">
      <a href="/users">
        <button class="button">USERS</button>
      </a>
    </div>
  </div>
  <div class="cell auto">
    <div class="grid-x grid-margin-x">
      <?php
      $count = UsersController::Display($result, true);
      ?>
    </div>
    <?php
    echo Pagination::Handle($page, '/users/', $count, 8);
    ?>
  </div>
  <div class="cell large-1 small-12"></div>
</div>