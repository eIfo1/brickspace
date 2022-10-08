<?php
$name = "Users";


use function CommonMark\Render\HTML;
use brickspace\helpers\OnlineChecker;
use brickspace\middleware\Auth;
use brickspace\controller\UsersController;

$page = SetPagination(@$page);

$result = UsersController::Get($conn, $page, false);
$count = 1;

if (!$result) {
  header('location: /dashboard');
  exit();
}
?>



<div class="grid-x grid-margin-x">
  <div class="cell large-3 small-12">
    <a href="/users/staff">
      <button class="button">STAFF</button>
    </a>
  </div>
  <div class="cell auto">
    <div class="grid-x grid-margin-x">
      <?php
      $count = UsersController::Display($result);
      ?>
    </div>
    <?php
    echo HandlePagination($page, '/users/', $count, 8);
    ?>
  </div>
  <div class="cell large-3 small-12"></div>
</div>