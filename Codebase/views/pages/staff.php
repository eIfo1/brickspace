<?php
$name = "Users";


use function CommonMark\Render\HTML;
use brickspace\middleware\OnlineChecker;

$page = SetPagination(@$page);

$limit = 8;
$offset = ($page - 1) * $limit;
$statement = $conn->prepare("SELECT * FROM users WHERE user_admin = 2 OR user_admin = 3 OR user_admin = 4 OR user_admin = 5 ORDER BY user_id ASC LIMIT :limit OFFSET :offset");
$statement->bindParam(':limit', $limit, PDO::PARAM_INT);
$statement->bindParam(':offset', $offset, PDO::PARAM_INT);
$statement->execute();
$result = $statement->fetchAll();
$count = 1;

if (!$result) {
  header('location: /dashboard');
  exit();
}
?>


<div class="row">
  <div class="col-8 col-center">
    <div class="row">
      <div class="col-6">
        <a href="/users">
          <button>USERS</button>
        </a>
      </div>
    </div>
    <div class="row">
      <?php
      foreach ($result as $user) {
        $count += 1;
      ?>
        <div class="col-6">
          <div class="card">
            <div class="ellipsis">
              <?php
              if (UserAdmin($user['user_admin'])) {
                echo "<a class='admin_label' href='/user/profile/$user[user_name]'>$user[user_name]</a>";
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
      ?>
      <div class="col-12">
        <?php
        echo HandlePagination($page, '/users/', $count, 8);
        ?>
      </div>
    </div>
  </div>
</div>