<?php

use brickspace\controller\auth\StatusController;
use brickspace\middleware\Auth;
use brickspace\utils\Toast;

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
  <div class="col-6">
    <div class="card">
      <h1 class="text-center">Dashboard</h1>
      <form action="/dashboard/status/" method="POST">
        <h3>
          Status
        </h3>
        <span>
          <?php echo StatusController::Get(); ?>
        </span>
        <br>
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
  <div class="col-6">
    <div class="card">
      <h1 class="text-center">Comments</h1>
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