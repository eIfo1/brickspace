<?php
function GetUserByID($pdo, $id)
{
  // use pdo to get user by id
  $sql = "SELECT * FROM users WHERE user_id = :user_id";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(':user_id' => $id));
  $result = $stmt->fetch();
  return $result;
}