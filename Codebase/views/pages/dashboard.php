<?php
$name = "Dashboard";
require_once("{$_SERVER['DOCUMENT_ROOT']}/views/header.php");
if (@$_SESSION['note']) {
  include("{$_SERVER['DOCUMENT_ROOT']}/functions/toast.php");
  ShowNote($_SESSION['note']);
  unset($_SESSION['note']);
}
?>

<h1>
  Welcome back, <?php out($_SESSION['Username']); ?>
</h1>


<?php
require_once("{$_SERVER['DOCUMENT_ROOT']}/views/footer.php");
?>