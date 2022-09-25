<?php

use brickspace\controller\auth\StatusController;
use brickspace\middleware\Auth;
use brickspace\utils\Toast;
use brickspace\helpers\Time;
use brickspace\controller\auth\WallController;
use brickspace\controller\BlogController;

Auth::Require();

$name = "Dashboard";
if (@$_SESSION['error']) {
  new Toast($_SESSION['error'], 0);
  unset($_SESSION['error']);
}
if (@$_SESSION['note']) {
  new Toast($_SESSION['note'], 1);
  unset($_SESSION['note']);
}
$statement = $conn->prepare("SELECT * FROM users WHERE user_name = :username");
$statement->bindParam(':username', $_SESSION['Username'], PDO::PARAM_STR);
$statement->execute();
$result = $statement->fetch();
$blog = BlogController::GetPosts();
?>

<script>
  $(document).ready(function() {
    $("#comments").load("/api/comments");
    setInterval(() => {
      $("#comments").load("/api/comments");
      console.log("Loading messages...");
    }, 10000);
  });
</script>
<div class="card">
  <h1 class="center">
    Dashboard
  </h1>
</div>
<div class="row">
  <div class="col-3">
    <div class="ellipsis">
      <div class="speech-bubble">
        <?php
        echo $result['user_status'];
        ?>
      </div>
      <br>
      <div class="card">
        <img src="/cdn/img/no-file.png" alt="Avatar" style="  display: block;
  margin-left: auto;
  margin-right: auto;">
        <h2 class="center">
          <?php echo $result['user_name']; ?>
        </h2>
      </div>
      <div class="card">
        <h2 class="center">
          User Info
        </h2>
        <br>
        <label>
          Account Birth: <span class="small" style="float: right;"><?php echo date("l, F d, Y", strtotime($result['user_created'])) ?></span>
        </label>
        <br>
        <label>
          Friends: <span class="small" style="float: right;">Placeholder</span>
        </label>
        <br>
        <label>
          Wall Posts:
          <span class="small" style="float: right;">
            <?php
            echo WallController::PostAmount($_SESSION['UserID']);
            ?>
          </span>
        </label>
      </div>
    </div>
  </div>
  <div class="col-4">
    <div class="card">
      <form action="/dashboard/status/" method="POST">
        <h3>
          Update Status
        </h3>
        <div class="input-container">
          <i class="fa fa-pencil icon"></i>
          <input class="input-field" type="text" placeholder="How are you feeling..." name="status" required>
        </div>
        <?php
        set_csrf();
        ?>
        <button type="submit" name="submit">Post Status</button>
      </form>
      <br>
    </div>
    <div class="card">
      <h1>Blog</h1>
      <p>Website updates and events will show up here.</p>
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
  <div class="col-5">
    <div class="card">
      <h1>Your Feed</h1>
      <p>A place where you can chat to all BrickSpace members!</p>
      <br>
      <button id="modal_button">Create Post</button>
    </div>
    <div id="comments"></div>
  </div>
</div>
<div id="modal" class="modal">
  <div class="content">
    <span class="close">&times;</span>
    <form action="/dashboard/wall/" method="POST">
      <h1>
        Create Wall Post
      </h1>
      <input type="text" placeholder="Your wall message here..." name="message" required>
      <br>
      <?php
      set_csrf();
      ?>
      <button type="submit" name="submit">Post Comment</button>
    </form>
  </div>
</div>

<script>
  var modal = document.getElementById("modal");
  var btn = document.getElementById("modal_button");
  var span = document.getElementsByClassName("close")[0];

  btn.onclick = function() {
    modal.style.display = "block";
    modal.style.opacity = "1";
  }
  span.onclick = function() {
    modal.style.opacity = "0";
    setTimeout(function() {
      modal.style.display = "none";
    }, 500);
  }
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.opacity = "0";
      setTimeout(function() {
        modal.style.display = "none";
      }, 500);
    }
  }
</script>