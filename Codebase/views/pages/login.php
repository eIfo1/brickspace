<?php

use brickspace\middleware\Auth;

Auth::Deny();
$name = "Login";
?>

<div class="grid-x grid-margin-x">
  <div class="cell large-3 small-12"></div>
  <div class="cell auto">
    <div class="card">
      <div class="form">
        <form action method="post">
          <h1>
            Login
          </h1>
          <label for="username" class="form-label uppercase light">Username</label>
          <input class="input-field" type="text" placeholder="Username" name="username">
          <label for="password" class="form-label uppercase light">Password</label>
          <input class="input-field" type="password" placeholder="Password" name="password">
          <?php
          set_csrf();
          ?>
          <button class="button" style="width: 100%">
            Login
          </button>
          <br>
          <small>
            No account? No worries. <a href="/sign-up">Sign-up!</a>
          </small>
        </form>
      </div>
    </div>
  </div>
  <div class="cell large-3 small-12"></div>
</div>
