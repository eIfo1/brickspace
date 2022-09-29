<?php

use brickspace\controller\BlogController;
use brickspace\middleware\Auth;

Auth::RequireAdmin();

$name = "Edit Blog Post";

$blog = BlogController::GetPost($conn, $id);

?>


  <div class="row">
    <div class="col-6 col-center">
      <div class="card">
      <h1>
        Edit Blog Post
      </h1>
      <form action="/blog/edit/<?php echo $id; ?>" method="post">
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" id="title" name="title" placeholder="Title..." value="<?php echo $blog['blog_title'] ?>">
        </div>
        <div class="form-group">
          <label for="content">Body</label>
          <textarea class="form-control" id="content" name="body" rows="3" placeholder="Body..."><?php echo $blog['blog_body'] ?></textarea>
        </div>
        <input type="hidden" value="<?php echo $id ?>" name="id">
        <div id="preview" class="preview">
          <p>Start typing and it will show up here...</p>
        </div>
        <?php
        set_csrf();
        ?>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
      </form>
      <script>
        // after every keypress, preview the content
        $('#content').keyup(function() {
          $('#preview').html($('#content').val());
        });
      </script>
      </div>
    </div>
  </div>