<?php
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
      <h1 class="text-center">Comments</h1>
    </div>
    <div id="comments"></div>
    <div class="card">
      <form action="/dashboard/wall/" method="POST">
        <div class="input-container">
          <i class="fa fa-comment icon"></i>
          <input class="input-field" type="text" placeholder="Your wall message here..." name="message" required>
        </div>
        <button type="submit" name="submit">Post</button>
      </form>
    </div>
  </div>
</div>