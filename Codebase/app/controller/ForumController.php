<?php

namespace brickspace\controller;

use PDO;

class ForumController
{
  /**
   * Gets all forum categories and returns them.
   * 
   * @param object $conn Database connection.
   * @author gilfoyle
   * 
   * @return array
   */
  public static function GetCategories($conn)
  {
    $statement = $conn->prepare("SELECT * FROM categories");
    $statement->execute();
    $cat = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $cat;
  }
  /**
   * Gets number of posts in category
   *
   * @param object $conn Database Connection
   * @param int $id Category ID
   * @return int $n Number of posts
   */
  public static function NumberOfPosts($conn, $id)
  {
    $statement = $conn->prepare("SELECT COUNT(*) FROM posts WHERE post_cat = :id");
    $statement->execute(array(':id' => $id));
    $n = $statement->fetch(PDO::FETCH_ASSOC);
    return $n["COUNT(*)"];
  }
  /**
   * Gets number of replies in category
   *
   * @param object $conn Database Connection
   * @param int $id Category ID
   * @return int $n Number of posts
   */
  public static function NumberOfReplies($conn, $id)
  {
    $statement = $conn->prepare("SELECT COUNT(*) FROM replies WHERE reply_cat = :id");
    $statement->execute(array(':id' => $id));
    $n = $statement->fetch(PDO::FETCH_ASSOC);
    return $n["COUNT(*)"];
  }

  public static function GetPosts($conn, $id) {
    $statement = $conn->prepare("SELECT * FROM posts WHERE post_cat = :id");
    $statement->execute([':id' => $id]);
    $cat = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $cat;
  }

  public static function GetCategory($conn, $id)
  {
    $statement = $conn->prepare("SELECT * FROM categories WHERE cat_id = :id");
    $statement->execute([':id' => $id]);
    $cat = $statement->fetch(PDO::FETCH_ASSOC);
    return $cat;
  }
}
