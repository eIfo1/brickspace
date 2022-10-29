<?php

use brickspace\middleware\Auth;

Auth::Deny();

$name = "Sign-Up";
?>

<div class="grid-x grid-margin-x">
  <div class="cell large-4 small-12"></div>
  <div class="cell auto">
    <div class="card">
      <form action method="post">
        <h1>
          Sign-Up
        </h1>
        <label for="username">Username</label>
          <input class="input-field" type="text" placeholder="Username" name="username" required>
        <label for="email">Email</label>
          <input class="input-field" type="email" placeholder="Email" name="email" required>
        <label for="password">Password</label>
          <input class="input-field" type="password" placeholder="Password" name="password" required>
        <label for="password_repeat">Password Repeat</label>
          <input class="input-field" type="password" placeholder="Password Repeat" name="password_repeat" required>
        <?php
        set_csrf();
        ?>
        <button class="button" style="width: 100%;">
          Sign-Up
        </button>
        <small>
          Already have an account? <a href="/login">Login!</a>
        </small>
      </form>
    </div>
  </div>
  <div class="cell large-4 small-12"></div>
</div>
