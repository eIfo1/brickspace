<?php

namespace brickspace\controller;

use brickspace\middleware\Auth;
use brickspace\helpers\OnlineChecker;

use PDO;
use TypeError;

class UsersController
{
  public static function Get($conn, $page, $staff = 0)
  {
    $limit = 8;
    $offset = ($page - 1) * $limit;
    switch ($staff) {
      case 1:
        $statement = $conn->prepare("SELECT * FROM users WHERE user_admin = 2 OR user_admin = 3 OR user_admin = 4 OR user_admin = 5 ORDER BY user_id ASC LIMIT :limit OFFSET :offset");
        break;
      case 0:
        $statement = $conn->prepare("SELECT * FROM users ORDER BY user_id ASC LIMIT :limit OFFSET :offset");
        break;
      default:
        throw new TypeError("UsersController@Get(conn, page, staff): staff is not boolean!");
    }
    $statement->bindParam(':limit', $limit, PDO::PARAM_INT);
    $statement->bindParam(':offset', $offset, PDO::PARAM_INT);
    $statement->execute();
    $users = $statement->fetchAll();
    return $users;
  }

  public static function Display($result)
  {
    $count = 1;
    foreach ($result as $user) {
      $count += 1;
?>
      <div class="cell small-12 large-6">
        <div class="card">
          <div class="ellipsis">
            <?php
            if (Auth::IsAdmin($user['user_admin'])) {
              echo "<a class='red red-hover' href='/user/profile/$user[user_name]'>$user[user_name]</a>";
            } else {
              echo "<a class='user_label' href='/user/profile/$user[user_name]'>$user[user_name]</a>";
            }
            OnlineChecker::onlineLabel($user['user_updated']);
            ?>
          </div>
        </div>
      </div>
    <?php
    }
    return $count;
  }
  public static function Count($conn)
  {
    $statement = $conn->query("SELECT COUNT(*) from users");
    $statement->execute();
    return $statement->fetch()['COUNT(*)'];
  }
}
