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
    loadComments();

    setInterval(() => {
      loadComments();
    }, 2000);
  });


  $(function() {
    $("#wall").submit(function(e) {

      //prevent Default functionality
      e.preventDefault();

      //get the action-url of the form
      var actionurl = e.currentTarget.action;

      //do your own request an handle the results
      $.ajax({
        url: '/dashboard/wall',
        type: 'POST',
        dataType: 'JSON',
        data: $("#wall").serialize(),
        success: function(data) {
          console.log(data);
          loadComments()
          console.log("Post!");
        },
      });
    });
  });


  function loadComments() {
    $("#comments").load("/api/comments");
  }
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
        <div class="card-container hide-for-large">
          <div class="card" style="background: linear-gradient(to bottom, rgb(13, 72, 123) 0%, rgb(30, 98, 154) 25.5% 25.5% ,var(--darker) 25.5%)">
            <img src="/cdn/img/avatar/thumbnail/<?php echo $result['avatar_link'] ?>.png" alt="Avatar" class="card-image-top">
            <h4 class="text-center">
              <?php echo $result['user_name'] ?>
            </h4>
            <div class="grid-x">
              <div class="cell auto text-center">
                <label class="upper-label text-ellipsis">FORUM POSTS</label>
                <label for="forum" class="lower-label">
                  0
                </label>
              </div>
              <div class="cell auto text-center">
                <label class="upper-label text-ellipsis">FRIENDS</label>
                <label for="forum" class="lower-label">
                  0
                </label>
              </div>
              <div class="cell auto text-center">
                <label class="upper-label text-ellipsis">NET WORTH</label>
                <label for="forum" class="lower-label">
                  0
                </label>
              </div>
            </div>
          </div>
        </div>
        <div class="card-container show-for-large">
          <div class="card" style="background: linear-gradient(to bottom, rgb(13, 72, 123) 0%,rgb(30, 98, 154) 30% 38.5% ,var(--darker) 38.5%)">
            <img src="/cdn/img/avatar/thumbnail/<?php echo $result['avatar_link'] ?>.png" alt="Avatar" class="card-image-top">
            <h4 class="text-center">
              <?php echo $result['user_name'] ?>
            </h4>
            <div class="grid-x">
              <div class="cell auto text-center">
                <label class="upper-label text-ellipsis">FORUM POSTS</label>
                <label for="forum" class="lower-label">
                  0
                </label>
              </div>
              <div class="cell auto text-center">
                <label class="upper-label text-ellipsis">FRIENDS</label>
                <label for="forum" class="lower-label">
                  0
                </label>
              </div>
              <div class="cell auto text-center">
                <label class="upper-label text-ellipsis">NET WORTH</label>
                <label for="forum" class="lower-label">
                  0
                </label>
              </div>
            </div>
          </div>
        </div>
        <br>
        <h2>
          <i class="fas fa-bullhorn"></i>
          Updates
        </h2>
        <div class="card no-padding">
          <?php
          BlogController::DisplayPosts_Dashboard($conn);
          ?>
        </div>

      </div>
      <div class="cell auto">
        <button class="button right u alert" data-open="status-modal">
          <i class="far fa-comment-dots"></i>
          Status
        </button>
        <br>
        <h2>
          <i class="fa fa-stream"></i>
          Feed
        </h2>
        <div class="card">
          <div id="comments"></div>
        </div>
        <div class="card">
          <form action="/dashboard/wall" method="POST" id="wall">
            <?php
            set_csrf();
            ?>
            <div class="grid-x align-middle align-center">
              <input type="text" placeholder="Your wall message here..." name="message" required class="input-group-field">
              <button type="submit" name="submit" class="button success input-group-button">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="cell small-12 large-2"></div>
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