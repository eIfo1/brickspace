<?php

use brickspace\controller\BlogController;
use brickspace\middleware\Auth;
use brickspace\utils\Toast;

Auth::RequireAdmin();

$name = "Edit Blog Post";

$blog = BlogController::GetPost($conn, $id);
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
        <label for="content">Body</label>
        <textarea class="form-control" id="content" name="body" rows="3" placeholder="Body..."><?php echo $blog['blog_body'] ?></textarea>
        <input type="hidden" value="<?php echo $id ?>" name="id">
        <div id="preview" class="preview">
          <p>Start typing and it will show up here...</p>
        </div>
        <?php
        set_csrf();
        ?>
        <button type="submit" name="submit" class="button primary">Submit</button>
      </form>
      <script>
        // after every keypress, preview the content
        $('#content').keyup(function() {
          $('#preview').html($('#content').val());
        });
      </script>
    </div>
  </div>
  <div class="cell small-12 large-2"></div>
</div>