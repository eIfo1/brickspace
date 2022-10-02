<?php

use brickspace\middleware\Auth;

Auth::RequireAdmin();

$name = "Admin";
?>

<div class="card">
  <div class="row">
    <div class="col-3">
      <?php
      include('sidebar.php');
      ?>
    </div>
    <div class="col-9">
      <h1>
        Create Blog Post
      </h1>
      <form action="/admin/blog/" method="post">
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" id="title" name="title" placeholder="Title...">
        </div>
        <div class="form-group">
          <label for="content">Body</label>
          <textarea class="form-control" id="content" name="body" rows="3" placeholder="Body..."></textarea>
        </div>
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