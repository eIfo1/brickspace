<?php

use brickspace\controller\ForumController;

$name = "Forum";
$cat = ForumController::GetCategories($conn);
?>

<div class="grid-margin-x grid-x">
  <div class="cell large-1 small-12"></div>
  <div class="cell auto">
    <div class="top">
      <i class="fas fa-cloud"></i> Forum
    </div>
    <div class="card card-has-top forum">
      <?php
      if (!$cat) {
      ?>
        <tr>
          <td>
            <h4>No Forum Categories</h4>
            <p>Contact website admins or wait patiently.</p>
          </td>
        </tr>
      <?php
      }
      ?>
      <?php
      foreach ($cat as $c) {
        $posts = ForumController::NumberOfPosts($conn, $c['cat_id']);
        $replies = ForumController::NumberOfReplies($conn, $c['cat_id']);
      ?>
            <h4>
              <a href="/forum/category/<?php echo $c['cat_id']; ?>">
                <?php
                echo $c['cat_name'];
                ?>
              </a>
            </h4>
            <p>
              <?php
              echo $c['cat_desc'];
              ?>
            </p>
      <?php
      }
      ?>
    </div>
    <!--
    <table>
      <thead>
        <tr>
          <th width="600">
            Category
          </th>
          <th class="text-center">
            Posts
          </th>
          <th class="text-center">
            Replies
          </th>
          <th class="text-center">
            Last Post
          </th>
        </tr>
      </thead>
      <tbody> 
        <?php
        if (!$cat) {
        ?>
            <tr>
              <td>
                <h4>No Forum Categories</h4>
                <p>Contact website admins or wait patiently.</p>
              </td>
            </tr>
            <?php
          }
            ?>
        <?php
        foreach ($cat as $c) {
          $posts = ForumController::NumberOfPosts($conn, $c['cat_id']);
          $replies = ForumController::NumberOfReplies($conn, $c['cat_id']);
        ?>
          <tr>
            <td>
              <h4>
                <a href="/forum/category/<?php echo $c['cat_id']; ?>">                
                <?php
                echo $c['cat_name'];
                ?>
                </a>
              </h4>
              <p>
                <?php
                echo $c['cat_desc'];
                ?>
              </p>
            </td>
            <td class="text-center">
              <label for="posts">
                <?php echo $posts; ?>
              </label>
            </td>
            <td class="text-center">
              <label for="replies">
                <?php echo $replies; ?>
              </label>
            </td>
            <td class="text-center">
              <label for="last">None</label>
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
      -->
  </div>
  <div class="cell large-1 small-12"></div>
</div>