<?php

use brickspace\middleware\Auth;
use brickspace\controller\admin\AlertController;
use brickspace\utils\Toast;

Auth::RequireAdmin();

$name = "Admin";
$alert = AlertController::Get();

if (@$_SESSION['error']) {
  new Toast($_SESSION['error'], 0);
  unset($_SESSION['error']);
}
if (@$_SESSION['note']) {
  new Toast($_SESSION['note'], 1);
  unset($_SESSION['note']);
}

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
      <form action method="post">
        <h3 for="alert_text">
          Alert Text
        </h3>
        <div class="input-container">
          <i class="fa fa-comment icon"></i>
          <input class="input-field" type="text" placeholder="Alert message..." name="alert_text" required id="alert_text" value="<?php echo $alert['text']; ?>">
        </div>
        <h3 for="alert_text">
          Alert Link
        </h3>
        <div class="input-container">
          <i class="fas fa-external-link-alt icon"></i>
          <input class="input-field" type="text" placeholder="Alert link..." name="alert_link" id="alert_link" value="<?php echo $alert['link']; ?>">
        </div>
        <h3 for=" alert_bool">
          Alert Settings
        </h3>
        <select class="form-control" name="alert_bool" id="select">
          <option value="1" <?php if ($alert['bool'] == 1) {
                              echo "selected";
                            } ?>>Alert Enabled</option>
          <option value="0" <?php if ($alert['bool'] == 0) {
                              echo "selected";
                            } ?>>Alert Disabled</option>
        </select>
        <?php
        set_csrf();
        ?>
        <button type="submit">
          Submit
        </button>
        <script>
          if ($('select').val() == 1) {
            $('#alert_text').prop("value", "<?php echo $alert['text']; ?>");
            $('#alert_text').prop("disabled", false);
            $('#alert_link').prop("value", "<?php echo $alert['link']; ?>");
            $('#alert_link').prop("disabled", false);
          } else {
            $('#alert_text').prop("value", "Alert Disabled...");
            $('#alert_text').prop("disabled", true);
            $('#alert_link').prop("value", "Alert Disabled...");
            $('#alert_link').prop("disabled", true);
          }
          $('#select').change(function() {
            if ($(this).val() == 1) {
              $('#alert_text').prop("value", "<?php echo $alert['text']; ?>");
              $('#alert_text').prop("disabled", false);
              $('#alert_link').prop("value", "<?php echo $alert['link']; ?>");
              $('#alert_link').prop("disabled", false);
            } else {
              $('#alert_text').prop("value", "Alert Disabled...");
              $('#alert_text').prop("disabled", true);
              $('#alert_link').prop("value", "Alert Disabled...");
              $('#alert_link').prop("disabled", true);
            }
          });
        </script>
      </form>
    </div>
  </div>
</div>