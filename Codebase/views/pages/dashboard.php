<?php
$name = "Dashboard";
require_once("{$_SERVER['DOCUMENT_ROOT']}/views/header.php");
if (@$_SESSION['note']) {
  ShowNote($_SESSION['note']);
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
        <input type="text" name="message" placeholder="Your wall message here..." required>
        <button type="submit" name="submit">Post</button>
      </form>
    </div>
  </div>
</div>


<?php
require_once("{$_SERVER['DOCUMENT_ROOT']}/views/footer.php");
?>