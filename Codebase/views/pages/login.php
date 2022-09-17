<?php
use brickspace\middleware\Auth;
Auth::Deny();
$name = "Login";
if (@$_SESSION['error']) {
  ShowError($_SESSION['error']);
  unset($_SESSION['error']);
}
?>

<div class="row">
  <div class="col-6 col-center">
    <div class="card">
      <div class="form">
        <form action method="post">
          <h1>
            Login
          </h1>
          <label for="username" class="form-label uppercase light">Username</label>
          <div class="input-container">
            <i class="fa fa-user icon"></i>
            <input class="input-field" type="text" placeholder="Username" name="username">
          </div>
          <label for="password" class="form-label uppercase light">Password</label>
          <div class="input-container">
            <i class="fa fa-key icon"></i>
            <input class="input-field" type="password" placeholder="Password" name="password">
          </div>
          <?php
          set_csrf();
          ?>
          <button>
            Login
          </button>
          <p class="small form-label">
            No account? No worries. <a href="/sign-up">Sign-up!</a>
          </p>
        </form>
      </div>
    </div>
  </div>
</div>
