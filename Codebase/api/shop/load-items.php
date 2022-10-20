<?php

use brickspace\controller\UsersController;
use brickspace\middleware\Auth;

$type = $_POST['type'];

include("$_SERVER[DOCUMENT_ROOT]/config/config.php");
if($type == "hidden") {
  if(!Auth::Admin()) {
    return;
  }
  $sql = "SELECT * FROM item WHERE public = 0 ORDER BY ID DESC";
  $items = $conn->prepare($sql);
  $items->execute();
  $items = $items->fetchAll(PDO::FETCH_ASSOC);
} else {
  $sql = "SELECT * FROM item WHERE type = :type AND public = 1 ORDER BY ID DESC";

  $items = $conn->prepare($sql);
  $items->execute(array(':type' => $type));;
  $items = $items->fetchAll(PDO::FETCH_ASSOC);
}

?>

<?php

if (!$items) {
  echo "No items here.";
}

?>
<div class="grid-x grid-margin-x">

  <style>
    .price {
      border-radius: 0 0 5px 5px;
      padding: 12px;
      background: var(--dark);
      color: #fff;
      font-weight: 600;
      display: block;
      overflow: hidden;
    }
    .shop-card a img {
      margin-left: auto;
      margin-right: auto;
      display: block;
      width: 100%;
    }
    .title {
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
  </style>

  <?php
  foreach ($items as  $item) {
    $u = UsersController::GetByID($conn, $item['creator']);
  ?>
    <div class="cell small-12 large-3">
      <div class="shop-card">
        <a href="/shop/item/<?php echo $item['id']; ?>">
          <img src="/cdn/img/shop/<?php echo md5($item['id']); ?>.png" alt="Item" style='border-radius: 5px 5px 0 0; padding: 12px;'>
          <div class="price">
            <h4 class="right">
              <i class="fa fa-cubes"></i>
            <?php 
            if($item['onsale'] != 0) {
              if($item['price'] != 0) {
                echo $item['price'];
              } else {
                echo 'FREE';
              }
            } else {
              echo "OFFSALE";
            }
            ?>
            </h4>
          </div>
        </a>
        <h4 class="title">
          <a href="/shop/item/<?php echo $item['id']; ?>">
            <?php
            echo $item['name'];
            ?>
          </a>
        </h4>
        <label for="creator">
          by <a href="/user/profile/<?php echo $u['user_name']; ?>">
            <?php echo $u['user_name']; ?>
          </a>
        </label>
      </div>
    </div>
  <?php
  }
  ?>
</div>