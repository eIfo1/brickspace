<?php
$name = "Landing";
if(UserAuthenticated()) {
  header('location: /dashboard');
  exit();
}
?>

<h1>
  BrickSpace
</h1>
