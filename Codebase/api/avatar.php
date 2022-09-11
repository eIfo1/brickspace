<?php 

require_once $_SERVER['DOCUMENT_ROOT'] . "/utils/StackImage.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/config/config.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions/auth.php";

if(!isset($id)) {
  $id = $_SESSION['UserID'];
}