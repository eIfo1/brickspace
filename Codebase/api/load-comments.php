<?php
include("$_SERVER[DOCUMENT_ROOT]/config/config.php");
include("$_SERVER[DOCUMENT_ROOT]/app/functions/functions.php");

use brickspace\helpers\Time;
// get number of wall posts
$statement = $conn->prepare("SELECT COUNT(*) AS count FROM wall");
$statement->execute();
$count = $statement->fetch(PDO::FETCH_ASSOC);
$count = $count['count'];
if ($count > 6) {
  $offset = $count - 6;
} else {
  $offset = 0;
}
// Get all wall posts, limit to 6, and order by newest first and offset by the number of posts already shown.
$statement = $conn->prepare("SELECT * FROM wall ORDER BY wall_id ASC LIMIT 6 OFFSET :offset");
// Set offset to the number of posts already shown.
$statement->bindParam(':offset', $offset, PDO::PARAM_INT);
$statement->execute();
$wall = $statement->fetchAll(PDO::FETCH_ASSOC);
// get blog posts
// get number of blog posts
$statement = $conn->prepare("SELECT COUNT(*) AS count FROM blog");
$statement->execute();
$count = $statement->fetch(PDO::FETCH_ASSOC);
$count = $count['count'];
if ($count > 6) {
  $offset = $count - 6;
} else {
  $offset = 0;
}
// get count of wall posts
$count = count($wall);
if ($count == 0) {
  echo "<p class='center'>No posts yet!</p>";
} else {
  foreach ($wall as $post) {
    $user = GetUserByID($conn, $post['wall_creator']);
?>
    <div class="card">
      <div class="ellipsis">
        <a href="/user/profile/<?php echo $user['user_name']; ?>">
          <?php
          echo $user['user_name'];
          ?>
        </a> - 
        <p style="display: inline-block">
          <?php
          echo Time::Elapsed($post['wall_created']);
          ?>
        </p>
      </div>
      <p>
        <?php
        echo $post['wall_message'];
        ?>
      </p>
    </div>
<?php
  }
}
?>