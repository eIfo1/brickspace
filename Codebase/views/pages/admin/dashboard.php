<?php

use brickspace\middleware\Auth;

Auth::RequireAdmin();

$name = "Admin Dashboard";

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
        Admin Dashboard
      </h1>
      <p>
        The time is: <?php echo date('h:i:s'); ?> EST
      </p>
    </div>
  </div>
</div>