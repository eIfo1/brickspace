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
        FAQ
      </h1>
      <details>
        <summary>
          Who can create blog posts?
        </summary>
        <p>
          Site developers and head staff can create blog posts. Blog posts are only meant to be created by those who have basic HTML knowledge as that's how the blog functions. This is also only restricted to admins due to site moderators really not needing to do this.
        </p>
      </details>
      <details>
        <summary>
          Who can put the site into maintenance?
        </summary>
        <p>
          Unlike blog posts, ONLY site developers can put the website into maintenance.
        </p>
      </details>
      <details>
        <summary>When to disable or enable a feature?</summary>
        <p>
          If a feature breaks, be sure to disable it immediately. If you disable a feature immediately after it breaks, nobody will notice it's gone (unless you're disabling something regularly used like the forums).
        </p>
      </details>
      <details>
        <summary>When to issue an alert?</summary>
        <p>
          Only issue an alert during site events, holidays (usually US holidays), to notify users about a disabled feature, to notify users about a new blog post, or even when new features come out.
          Alerts can also be issued to alert others about scheduled maintenance.
        </p>
      </details>
    </div>
  </div>
</div>