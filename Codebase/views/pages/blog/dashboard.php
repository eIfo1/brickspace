<?php

use brickspace\controller\BlogController;
use brickspace\helpers\Time;

$page = SetPagination(@$page);

$name = "Blog";

?>

<div class="row">
  <div class="col-7 col-center">
    <div class="card">
      <h1>
        <i class="fa fa-rss"></i> Blog
      </h1>
    </div>
    <?php
      BlogController::DisplayPosts();
    ?>
  </div>
</div>