<?php

use brickspace\controller\BlogController;
use brickspace\helpers\Pagination;

$page = Pagination::Set(@$page);

$name = "Blog";

?>

<div class="grid-x grid-margin-x">
  <div class="cell large-4 small-12"></div>
  <div class="cell auto">
    <div class="card">
      <h1>
        <i class="fa fa-rss"></i> Blog
      </h1>
    </div>
    <?php
    BlogController::DisplayPosts($conn);
    ?>
  </div>
  <div class="cell large-4 small-12"></div>
</div>

<div class="row">
  <div class="col-7 col-center">
  </div>
</div>