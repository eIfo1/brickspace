<?php
$name = "Sign-Up";
require_once("{$_SERVER['DOCUMENT_ROOT']}/views/header.php");
if (@$_SESSION['error']) {
  include("{$_SERVER['DOCUMENT_ROOT']}/functions/toast.php");
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
            Sign-Up
          </h1>
          <label for="username" class="form-label uppercase light">Username</label>
          <div class="input-container">
            <i class="fa fa-user icon"></i>
            <input class="input-field" type="text" placeholder="Username" name="username" required>
          </div>
          <label for="email" class="form-label uppercase light">Email</label>
          <div class="input-container">
            <i class="fa fa-envelope icon"></i>
            <input class="input-field" type="email" placeholder="Email" name="email" required>
          </div>
          <label for="password" class="form-label uppercase light">Password</label>
          <div class="input-container">
            <i class="fa fa-key icon"></i>
            <input class="input-field" type="password" placeholder="Password" name="password" required>
          </div>
          <label for="password_repeat" class="form-label uppercase light">Password Repeat</label>
          <div class="input-container">
            <i class="fa fa-key icon"></i>
            <input class="input-field" type="password" placeholder="Password Repeat" name="password_repeat" required>
          </div>
          <?php
          set_csrf();
          ?>
          <button>
            Sign-Up
          </button>
          <p class="small form-label">
            Already have an account? <a href="/login">Login!</a>
          </p>
        </form>
      </div>
    </div>
  </div>
</div>


<?php
require_once("{$_SERVER['DOCUMENT_ROOT']}/views/footer.php");
?>