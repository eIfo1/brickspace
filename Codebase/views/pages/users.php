<?php
$name = "Users";


use function CommonMark\Render\HTML;
use brickspace\helpers\OnlineChecker;
use brickspace\middleware\Auth;

$page = SetPagination(@$page);

$limit = 8;
$offset = ($page - 1) * $limit;
$statement = $conn->prepare("SELECT * FROM users ORDER BY user_id ASC LIMIT :limit OFFSET :offset");
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
  <div class="col-6 col-center">
    <div class="row">
      <div class="col-6">
        <a href="/users/staff">
          <button>STAFF</button>
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
                if(Auth::IsAdmin($user['user_admin'])) {
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