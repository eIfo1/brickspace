<?php

use brickspace\controller\auth\StatusController;
use brickspace\middleware\Auth;
use brickspace\utils\Toast;
use brickspace\helpers\Time;

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
            //echo WallController::PostAmount($_SESSION['UserID']); 
            ?>
          </span>
        </label>
      </div>
    </div>
  </div>
  <div class="col-4">
    <div class="card">
      <h1 class="center">Dashboard</h1>
    </div>
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
        <button type="submit" name="submit">Post</button>
      </form>
    </div>
  </div>
  <div class="col-5">
    <div class="card">
      <h1 class="center">Website Wall</h1>
    </div>
    <div id="comments"></div>
    <div class="card">
      <form action="/dashboard/wall/" method="POST">
        <div class="input-container">
          <i class="fa fa-comment icon"></i>
          <input class="input-field" type="text" placeholder="Your wall message here..." name="message" required>
        </div>
        <?php
        set_csrf();
        ?>
        <button type="submit" name="submit">Post</button>
      </form>
    </div>
  </div>
</div>