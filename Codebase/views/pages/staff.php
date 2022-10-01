<?php
$name = "Users";


use function CommonMark\Render\HTML;

use brickspace\controller\UsersController;
use brickspace\helpers\OnlineChecker;
use brickspace\middleware\Auth;

$page = SetPagination(@$page);

$result = UsersController::Get($conn, $page, true);
$count = 1;

if (!$result) {
  header('location: /dashboard');
  exit();
}
?>


<div class="row">
  <div class="col-6 col-center">
    <div class="row">
      <div class="col-6">
        <a href="/users">
          <button>USERS</button>
        </a>
      </div>
    </div>
    <br>
    <div class="row">
      <?php
        $count = UsersController::Display($result);
      ?>
      <div class="col-12">
        <?php
        echo HandlePagination($page, '/users/', $count, 8);
        ?>
      </div>
    </div>
  </div>
</div>