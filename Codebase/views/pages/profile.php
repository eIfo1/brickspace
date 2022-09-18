<?php
use brickspace\middleware\Auth;
use brickspace\helpers\OnlineChecker;
if (!isset($username)) {
  if (Auth::Auth()) {
    $username = $_SESSION['Username'];
    $name = $username;
  } else {
    header('location: /');
    exit();
  }
} else {
  $name = $username;
}
$statement = $conn->prepare("SELECT * FROM users WHERE user_name = :username");
$statement->bindParam(':username', $username, PDO::PARAM_STR);
$statement->execute();
$result = $statement->fetch();
if(!$result) {
  header('location: /user/profile');
  exit();
}
?>

<div class="row">
  <div class="col-4">
    <div class="ellipsis">
      <div class="speech-bubble">
        <?php
        echo $result['user_status'];
        ?>
      </div>
      <br>
      <h2 class="title">
        <?php echo $result['user_name']; ?>
      </h2>
      <?php
        OnlineChecker::onlineLabel($result['user_updated'], true);
      ?>
    </div>
    <br>
    <div class="card">
      <h1>
      <?php
      echo $result['user_bio'];
      ?>
      </h1>
    </div>
    <br>
    <div class="card">
    </div>
  </div>
</div>