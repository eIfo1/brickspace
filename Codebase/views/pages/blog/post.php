<?php

use brickspace\controller\BlogController;
use brickspace\helpers\Time;
use brickspace\middleware\Auth;

$name = "Blog";

if (!is_numeric($id)) {
  header('location: /blog');
  exit();
}

$blog = BlogController::GetPost($conn, $id);

if (!$blog) {
  header('location: /blog');
  exit();
}

$user = GetUserByID($conn, $blog['blog_creator']);

?>

<div class="row">
  <div class="col-7 col-center">
    <div class="card">
      <h1><?php echo $blog['blog_title']; ?></h1>
      <p class="small">
        <?php echo Time::Elapsed($blog['blog_created']); ?>
      </p>
    </div>
    <div class="card">
      <?php
      echo $blog['blog_body'];
      ?>
    </div>
    <div class="card">
      <span>Created by <a href="/user/profile/<?php echo $user['user_name']; ?>"><?php echo $user['user_name']; ?></a> on <strong><?php echo date("l, F d, Y", strtotime($blog['blog_created'])) ?></strong></span>
      <br>
      <br>
      <?php
      if (Auth::Admin()) {
      ?>
        <form method="POST" action="/blog/delete/<?php echo $id ?>" style="display: inline-block">
          <?php set_csrf(); ?>
          <input type="hidden" name="id" value="<?php echo $id?>">
          <button class="red">DELETE</button>
        </form>
        <a href="/blog/edit/<?php echo $id ?>">
          <button>EDIT</button>
        </a>
      <?php
      }
      ?>
    </div>
  </div>
</div>