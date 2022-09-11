<?php
$name = "Landing";
require_once("{$_SERVER['DOCUMENT_ROOT']}/views/header.php");
if(UserAuthenticated()) {
  header('location: /dashboard');
  exit();
}
?>

<h1>
  RobloxClone
</h1>

<?php
require_once("{$_SERVER['DOCUMENT_ROOT']}/views/footer.php");
?>