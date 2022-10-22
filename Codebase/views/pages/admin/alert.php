<?php

use brickspace\middleware\Auth;
use brickspace\controller\admin\AlertController;

Auth::RequireAdmin();

$name = "Admin";
$alert = AlertController::Get($conn);

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
    <div class="top">
      <i class="fa fa-exclamation-triangle"></i> Website Alert
    </div>
    <div class="card card-has-top">
      <form action method="post">
        <h3 for="alert_text">
          Alert Text
        </h3>
        <input type="text" placeholder="Alert message..." name="alert_text" required id="alert_text" value="<?php echo $alert['text']; ?>">
        <h3 for="alert_text">
          Alert Link
        </h3>
        <input type="text" placeholder="Alert link..." name="alert_link" id="alert_link" value="<?php echo $alert['link']; ?>">
        <h3 for="alert_bool">
          Alert Settings
        </h3>
        <select name="alert_bool" id="select">
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
        <button type="submit" class="button">
          Submit
        </button>
        <script>
          if ($('select').val() == 1) {
            $('#alert_text').prop("value", "<?php echo $alert['text']; ?>");
            $('#alert_text').prop("disabled", false);
            $('#alert_link').prop("value", "<?php echo $alert['link']; ?>");
            $('#alert_link').prop("disabled", false);
          } else {
            $('#alert_text').prop("disabled", true);
            $('#alert_link').prop("disabled", true);
          }
          $('#select').change(function() {
            if ($(this).val() == 1) {
              $('#alert_text').prop("value", "<?php echo $alert['text']; ?>");
              $('#alert_text').prop("disabled", false);
              $('#alert_link').prop("value", "<?php echo $alert['link']; ?>");
              $('#alert_link').prop("disabled", false);
            } else {
              $('#alert_text').prop("disabled", true);
              $('#alert_link').prop("disabled", true);
            }
          });
        </script>
      </form>
    </div>
  </div>
</div>