<?php

namespace brickspace\controller;

use brickspace\middleware\Auth;
use brickspace\helpers\Time;
use PDO;

class BlogController
{
  /**
   * Gets all the blog (limit 6 in descending order) posts and returns them.
   * 
   * @param object $conn The database connection
   *  
   * @return array $blog The blog posts
   * @author gilfoyle
   *  
  */
  public static function GetPosts($conn)
  {
    $statement = $conn->prepare("SELECT * FROM blog ORDER BY blog_id DESC LIMIT 6");
    $statement->execute();
    $blog = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $blog;
  }

  /**
   * Gets a singular blog post.
   * 
   * @param object $conn The database connection
   * @param int $id The post's id
   *  
   * @return array $blog The blog post
   * @author gilfoyle
   *  
   */
  public static function GetPost($conn, $id)
  {
    $statement = $conn->prepare("SELECT * FROM blog WHERE blog_id = :id");
    $statement->execute(array(':id' => $id));
    $blog = $statement->fetch(PDO::FETCH_ASSOC);
    return $blog;
  }
  /**
   * Posts a blog post. (post request)
   *
   * @return void
   * @author gilfoyle
   */
  public static function Post()
  {
    Auth::RequireAdmin();
    include($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
    if (!is_csrf_valid()) {
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

  /**
   * Edits a blog post. (post request)
   *
   * @return void
   * @author gilfoyle
   */
  public static function Edit()
  {
    Auth::RequireAdmin();

    include($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
    if (!is_csrf_valid()) {
      header('location: /dashboard');
      exit();
    }
    $title = $_POST['title'];
    $body = $_POST['body'];
    $id = $_POST['id'];

    if (empty($title) || empty($body)) {
      $_SESSION['error'] = 'Title or body is empty!';
      header('location: /blog/edit/$id');
      exit();
    }
    $statement = $conn->prepare("UPDATE blog SET blog_title = :title,  blog_body = :body WHERE blog_id = :id");
    $statement->execute(array(':title' => $title, ':body' => $body, ':id' => $id));
    $_SESSION['note'] = 'Blog post updated!';
    header('location: /blog/');
    exit();
  }

  /**
   * Deletes  a blog post. (post request)
   *
   * @return void
   * @author gilfoyle
   */
  public static function Delete()
  {
    Auth::RequireAdmin();
    include($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
    if (!is_csrf_valid()) {
      header('location: /dashboard');
      exit();
    }

    $id = $_POST['id'];

    $statement = $conn->prepare("DELETE FROM blog WHERE blog_id = :id");
    $statement->execute(array(':id' => $id));
    $_SESSION['note'] = 'Blog post deleted!';
    header('location: /blog');
    exit();
  }
  /**
   * Displays all blog posts.
   *
   * @param $conn The database connection
   * 
   * @return void
   * @author gilfoyle
   */
  public static function DisplayPosts($conn)
  {
    $blog = BlogController::GetPosts($conn);

    if (!$blog) {
?>
      <div class="card">
        <p>Nothing to see here.</p>
      </div>
    <?php
    }

    foreach ($blog as $post) {
      $user = GetUserByID($conn, $post['blog_creator']);
    ?>
      <div class="card">
        <div class="ellipsis">
          <a href="/blog/post/<?php echo $post['blog_id']; ?>">
            <span style="display: inline-block;"><i class="fa fa-file"></i> <?php echo $post['blog_title']; ?></span><span> <?php
                                                                                                                            if (strtotime($post['blog_created']) > strtotime("-24 hours")) {
                                                                                                                              echo "<div class='label alert'>New</div>";
                                                                                                                            }
                                                                                                                            ?></span>
          </a>
          <br>
          <small>
            <?php echo Time::Elapsed($post['blog_created']); ?>
          </small>
        </div>
        <span>
          <a href="/user/profile/<?php echo $user['user_name']; ?>"><?php echo $user['user_name']; ?></a><strong> on <?php echo date("l, F d, Y", strtotime($post['blog_created'])) ?></strong>
        </span>
      </div>
<?php
    }
  }
}
