<?php

use brickspace\controller\BlogController;
use brickspace\helpers\Time;

$page = SetPagination(@$page);

$name = "Blog";

$blog = BlogController::GetPosts();

?>

<div class="row">
  <div class="col-7 col-center">
    <div class="card">
      <h1>
        <i class="fa fa-rss"></i> Blog
      </h1>
    </div>
    <?php
    if (!$blog) {
      echo "No blog posts...";
    }

    foreach ($blog as $post) {
      $user = GetUserByID($conn, $post['blog_creator']);
    ?>
      <div class="card">
        <div class="ellipsis">
          <a href="/blog/post/<?php echo $post['blog_id']; ?>">
            <h2 style="display: inline-block;"><i class="fa fa-file"></i> <?php echo $post['blog_title']; ?></h2>
          </a>
          <p class="small" style="margin: 5px 0; margin-top: -6px; display: inline-block;">
            <?php echo Time::Elapsed($post['blog_created']); ?>
            <?php
            // if blog post was created in last 24 hours, show "new" badge
            if (strtotime($post['blog_created']) > strtotime("-120 seconds")) {
              echo "<span class='badge admin-text'>New</span>";
            }
            ?>
          </p>
        </div>
        <a href="/user/profile/<?php echo $user['user_name']; ?>"><?php echo $user['user_name']; ?></a> on <strong><?php echo date("l, F d, Y", strtotime($post['blog_created'])) ?></strong>
      </div>
    <?php
    }
    ?>
  </div>
</div>