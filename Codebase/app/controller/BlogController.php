<?php 

namespace brickspace\controller;
use PDO;

class BlogController {
  public static function GetPosts($offset = 0) {
    include($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
    $statement = $conn->prepare("SELECT * FROM blog ORDER BY blog_id ASC LIMIT 6 OFFSET :offset");
    $statement->bindParam(':offset', $offset, PDO::PARAM_INT);
    $statement->execute();
    $blog = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $blog;
  }
}