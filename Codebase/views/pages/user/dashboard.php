<?php

use brickspace\middleware\Auth;
use brickspace\helpers\Time;
use brickspace\controller\auth\WallController;
use brickspace\controller\BlogController;

Auth::Require();

$name = "Dashboard";
$statement = $conn->prepare("SELECT * FROM users WHERE user_id = :userid");
$statement->bindParam(':userid', $_SESSION['UserID'], PDO::PARAM_INT);
$statement->execute();
$result = $statement->fetch();
$blog = BlogController::GetPosts($conn);
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
          Account Birth: <span class="small" style="float: right;"><?php echo Time::Date($result['user_created']) ?></span>
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
            echo WallController::PostAmount($conn, $_SESSION['UserID']);
            ?>
          </span>
        </label>
      </div>
    </div>
  </div>
  <div class="col-5">
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
    BlogController::DisplayPosts($conn);
    ?>
  </div>
  <div class="col-4">
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
    <form action="/dashboard/wall/" method="POST">
      <div class="modal-container">
        <h1>
          Create Wall Post
        </h1>
        <input type="text" placeholder="Your wall message here..." name="message" required>
        <br>
        <?php
        set_csrf();
        ?>
      </div>
      <div class="buttons">
        <button class="red" id="close" type="button">Cancel</button>
        <button type="submit" name="submit">Submit</button>
      </div>
    </form>
  </div>
</div>

<script>
  var modal = document.getElementById("modal");
  var btn = document.getElementById("modal_button");
  var close = document.getElementById("close");

  function closeModal() {
    modal.style.opacity = "0";
    setTimeout(function() {
      modal.style.display = "none";
    }, 500);
  }

  close.onclick = function() {
    closeModal();
  }

  btn.onclick = function() {
    modal.style.display = "block";
    modal.style.opacity = "1";
  }
  window.onclick = function(event) {
    if (event.target == modal) {
      closeModal();
    }
  }
</script>