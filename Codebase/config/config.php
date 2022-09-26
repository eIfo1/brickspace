

<?php
$DEBUG = true;

echo $_SERVER['HTTP_HOST'];
try {
  if($_SERVER['HTTP_HOST'] != 'localhost') {
    $conn = new PDO("mysql:doadmin:AVNS_F7v0091UCWwurZGDMPT@brickspace-db-do-user-11026856-0.b.db.ondigitalocean.com:25060/defaultdb?ssl-mode=REQUIRED");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    exit();
  } else {
    $conn = new PDO("mysql:host=localhost;dbname=forum2", "root", "DatabasePass");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    date_default_timezone_set('America/New_York');
  }
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
