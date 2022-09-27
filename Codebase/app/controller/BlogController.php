<?php 

namespace brickspace\controller;
use brickspace\middleware\Auth;
use brickspace\helpers\Time;
use PDO;

class BlogController {
  public static function GetPosts($conn) {
    $statement = $conn->prepare("SELECT * FROM blog ORDER BY blog_id DESC LIMIT 6");
    $statement->execute();
    $blog = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $blog;
  }

  public static function GetPost($conn, $id) {
    $statement = $conn->prepare("SELECT * FROM blog WHERE blog_id = :id");
    $statement->execute(array(':id' => $id));
    $blog = $statement->fetch(PDO::FETCH_ASSOC);
    return $blog;
  }

  public static function Post() {
    Auth::RequireAdmin();
    include($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
    if(!is_csrf_valid()) {
      header('location: /dashboard');
      exit();
    }
    $title = $_POST['title'];
    $body = $_POST['body'];

    // flood check
    /*if (Flood($_SESSION['UserID'], 60)) {
      $_SESSION['error'] = "Try again in 60 seconds!";
      header("Location: /admin/blog");
      exit();
    }*/

    if (empty($title) || empty($body)) {
      $_SESSION['error'] = 'Title or body is empty!';
      header('location: /admin/blog');
      exit();
    }

    $staffLog = "Created a new blog post titled: " . $title . " on " . date("Y-m-d H:i:s");
    //StaffLog($_SESSION['UserID'], $staffLog);

    //SetUserFlood($_SESSION['UserID']);

    $statement = $conn->prepare("INSERT INTO blog (blog_title, blog_body, blog_created, blog_creator) VALUES (:title, :body, NOW(), :creator)");
    $statement->execute(array(':title' => $title, ':body' => $body, ':creator' => $_SESSION['UserID']));
    $_SESSION['note'] = 'Blog post created!';
    header('location: /admin/blog');
    exit();
  }

  public static function DisplayPosts($conn) {
    $blog = BlogController::GetPosts($conn);

    foreach ($blog as $post) {
      $user = GetUserByID($conn, $post['blog_creator']);
    ?>
      <div class="card">
        <div class="ellipsis">
          <a href="/blog/post/<?php echo $post['blog_id']; ?>">
            <h2 style="display: inline-block;"><i class="fa fa-file"></i> <?php echo $post['blog_title']; ?></h2>
            <?php
            if (strtotime($post['blog_created']) > strtotime("-24 hours")) {
              echo "<span class='badge red'>New</span>";
            }
            ?>
          </a>
          <br>
          <p class="small" style="margin: 5px 0; margin-top: -6px; display: inline-block;">
            <?php echo Time::Elapsed($post['blog_created']); ?>
          </p>
        </div>
        <a href="/user/profile/<?php echo $user['user_name']; ?>"><?php echo $user['user_name']; ?></a> on <strong><?php echo date("l, F d, Y", strtotime($post['blog_created'])) ?></strong>
      </div>
    <?php
    }
  }
}