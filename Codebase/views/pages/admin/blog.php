<?php

use brickspace\middleware\Auth;

Auth::RequireAdmin();

$name = "Admin";
?>

<div class="grid-x grid-margin-x">
  <div class="small-12 large-3">
    <div class="card">
      <?php
      include('sidebar.php');
      ?>
    </div>
  </div>
  <div class="small-12 large-9">
    <div class="card">
      <h1>
        Create Blog Post
      </h1>
      <form action="/admin/blog/" method="post">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Title...">
        <label for="content">Body</label>
        <textarea class="form-control" id="blog_content" name="body" rows="3" placeholder="Body..."></textarea>
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