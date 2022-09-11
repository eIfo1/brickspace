<?php
date_default_timezone_set('America/New_York');

$DEBUG;
$DEBUG = true;

try {
  $conn = new PDO("mysql:host=db-mysql-nyc1-07068-do-user-11026856-0.b.db.ondigitalocean.com;dbname=defaultdb", "doadmin", "AVNS_7c4psrlopnStklIHZAZ ");
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

// remove error if debug is false
if ($DEBUG == true) {
  // show php errors
  ini_set('display_errors', 1);
  error_reporting(E_ALL);
} else {
  // hide php errors
  ini_set('display_errors', 0);
  error_reporting(0);
}

// hide notices
error_reporting(E_ALL & ~E_NOTICE);
