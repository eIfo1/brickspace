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
        Admin Dashboard
      </h1>
      <p>
        The time is: <?php echo date('h:i:s'); ?> EST
      </p>
    </div>
  </div>
</div>
