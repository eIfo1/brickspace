<?php

use brickspace\controller\BlogController;
use brickspace\middleware\Auth;
use brickspace\utils\Toast;

Auth::RequireAdmin();

$name = "Edit Blog Post";

if (!is_numeric($id)) {
  header('location: /blog');
  exit();
}


$blog = BlogController::GetPost($conn, $id);
if (!$blog) {
  header('location: /blog');
  exit();
}
?>


<div class="grid-margin-x grid-x">
  <div class="cell small-12 large-2"></div>
  <div class="cell auto">
    <div class="card">
      <h1>
        Edit Blog Post
      </h1>
      <form action="/blog/edit/<?php echo $id; ?>" method="post">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Title..." value="<?php echo $blog['blog_title'] ?>">
        <label for=" content">Body</label>
        <textarea class="form-control" id="blog_content" name="body" rows="3" placeholder="Body..."><?php echo $blog['blog_body'] ?></textarea>
        <div id="blog_preview" class="preview">
          <p>Start typing and it will show up here...</p>
        </div>
        <?php
        set_csrf();
        ?>
        <button type="submit" name="submit" class="button">Submit</button>
      </form>
    </div>
  </div>
  <div class="cell small-12 large-2"></div>
</div>