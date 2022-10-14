<?php

namespace brickspace\controller;

use brickspace\middleware\Auth;
use brickspace\helpers\OnlineChecker;

use PDO;
use TypeError;

class UsersController
{
  /**
   * Gets all users.
   *
   * @param [type] $conn
   * @param int $page 
   * @param boolean $staff Optional, if set to true it selects all admin users.
   * @return void
   */
  public static function Get($conn, $page, $staff = 0)
  {
    if(!is_numeric($page)) {
      header('location: /users');
    }

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

    if (!$users) {
      header('location: /dashboard');
      exit();
    }

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
            <div>
              <div class="icon-container">
                <a href="/user/profile/<?php echo $user['user_name']?>">
                  <img src="/cdn/img/avatar/thumbnail/<?php echo $user['avatar_link'] ?>.png" alt="<?php echo $user['user_name'] ?>'s avatar" class="avatar_thumbnail left">
                </a>
                <div class="status-circle 
                <?php 
                if (OnlineChecker::check($user['user_updated']) == true) { 
                  echo "online";
                } 
                ?>"></div>
              </div>
            <?php
            if (Auth::IsAdmin($user['user_admin'])) {
              echo "<a class='red red-hover' href='/user/profile/$user[user_name]'>$user[user_name]</a>";
            } else {
              echo "<a class='user_label' href='/user/profile/$user[user_name]'>$user[user_name]</a>";
            }
            ?>
            </div>

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

  public static function GetByID($conn, $id) {
    // use pdo to get user by id
    $sql = "SELECT * FROM users WHERE user_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array(':user_id' => $id));
    $result = $stmt->fetch();
    return $result;
  }
}
