<?php

use brickspace\middleware\Auth;
Auth::Require();

$name = "(0) Notifications";

?>

<div class="row">
  <div class="col-6 col-center">
    <div class="card">
      <h1>
        Notifications
      </h1>
    </div>
    <div id="notifications"></div>
  </div>
</div>