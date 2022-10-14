<?php

use brickspace\middleware\Auth;
use brickspace\helpers\Time;
use brickspace\controller\auth\WallController;
use brickspace\controller\BlogController;
use brickspace\controller\UsersController;

Auth::Require();

$name = "Dashboard";
$result = UsersController::GetByID($conn, $_SESSION['UserID']);
$blog = BlogController::GetPosts($conn);
?>

<script>
  $(document).ready(function() {
    $("#comments").load("/api/comments");
    setInterval(() => {
      $("#comments").load("/api/comments");
      console.log("Loading messages...");
    }, 40000000);
  });
</script>

<div class="grid-x grid-padding-x">
  <div class="cell small-12 large-2"></div>
  <div class="cell auto">
    <div class="grid-x grid-padding-x">
      <div class="cell auto">
        <h2>
          <i class="fas fa-tachometer-alt"></i>
          Dashboard
        </h2>
        <div class="card">
          <h4 class="text-center">
            <?php echo $result['user_name'] ?>
          </h4>
          <img src="/cdn/img/avatar/<?php echo md5($result['user_id']) ?>.png" alt="Avatar" style="padding: 12px; width: 150px; margin-left: auto; margin-right: auto;">
        </div>
        <br>
        <h2>
          <i class="fas fa-rss"></i>
          Blog
        </h2>
        <?php
        BlogController::DisplayPosts($conn);
        ?>
      </div>
      <div class="cell auto">
        <button class="button right u" data-open="post-modal">
          <i class="fa fa-plus"></i>
          Create Post
        </button>
        <button class="button right u alert" data-open="status-modal">
          <i class="far fa-comment-dots"></i>
          Status
        </button>
        <br>
        <h2>
          <i class="fa fa-stream"></i>
          Feed
        </h2>
        <div id="comments"></div>
      </div>
    </div>
  </div>
  <div class="cell small-12 large-2"></div>
</div>

<div class="reveal" id="post-modal" data-reveal="real" data-animation-in="fade-in" data-animation-out="fade-out">
  <form action="/dashboard/wall/" method="POST">
    <h1>
      Create Wall Post
    </h1>
    <input type="text" placeholder="Your wall message here..." name="message" required>
    <div class="divider"></div>
    <?php
    set_csrf();
    ?>
    <button class="button alert" id="close" type="button" data-close="post-modal">Cancel</button>
    <button type="submit" name="submit" class="button success">Submit</button>
  </form>
</div>

<div class="reveal" id="status-modal" data-reveal="real" data-animation-in="fade-in" data-animation-out="fade-out">
  <form action="/dashboard/status/" method="POST">
    <h1>
      <i class="far fa-comment-dots"></i> Update Status
    </h1>
    <input type="text" placeholder="How are you?" name="status" required>
    <div class="divider"></div>
    <?php
    set_csrf();
    ?>
    <button class="button alert" id="close" type="button" data-close="status-modal">Cancel</button>
    <button type="submit" name="submit" class="button success">Submit</button>
  </form>
</div>