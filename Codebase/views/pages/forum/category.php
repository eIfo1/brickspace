<?php

use brickspace\controller\ForumController;

$category = ForumController::GetCategory($conn, $id);
$posts = ForumController::GetPosts($conn, $id);

$name = $category['cat_name'];
?>