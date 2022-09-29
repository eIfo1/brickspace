<?php

use brickspace\controller\BlogController;
use brickspace\helpers\Time;
use brickspace\utils\Toast;



$page = SetPagination(@$page);

$name = "Blog";
if (@$_SESSION['note']) {
  new Toast($_SESSION['note'], 1);
  unset($_SESSION['note']);
}

?>

<div class="row">
  <div class="col-7 col-center">
    <div class="card">
      <h1>
        <i class="fa fa-rss"></i> Blog
      </h1>
    </div>
    <?php
      BlogController::DisplayPosts($conn);
    ?>
  </div>
</div>