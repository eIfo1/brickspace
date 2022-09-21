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
        Website Alert
      </h1>
    </div>
  </div>
</div>