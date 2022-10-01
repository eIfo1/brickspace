<?php

use brickspace\middleware\Auth;

Auth::Require();

$name = "Notifications";

?>

<div class="row">
  <div class="col-6 col-center">
    <div class="card">
      <h1>
        Notifications
      </h1>
    </div>
    <div id="notifications">
      <div class="card">
        <div class="ellipsis">
          <a href="#">elfo_alt</a>
          <label for="date" style="float: right;">
            10 seconds ago
          </label>
        </div>
        <p>
          Mentioned you in a forum post titled <strong>"fuck you"</strong>.
        </p>
      </div>
      <div class="card">
        <div class="ellipsis">
          <a href="#">BrickSpace</a>
          <label for="date" style="float: right;">
            23 hours ago
          </label>
        </div>
        <p>
          Your account may have been compromised. Click <a href="/account/settings">here</a> to change your password.
        </p>
      </div>
      <div class="ellipsis">
        <a id="prev" style="float: left" href="$link$previous">
          <i class="fas fa-angle-double-left"></i>
          Previous
        </a>
        <a id="next" style="float: right" href="$link$next">
          Next
          <i class="fa fa-angle-double-right"></i>
        </a>
      </div>
    </div>
  </div>
</div>