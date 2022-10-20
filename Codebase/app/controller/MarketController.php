<?php 

namespace brickspace\controller;

use brickspace\middleware\Auth;

class MarketController {
  /**
   * Creates a market item
   * Admin only
   *
   * @return void
   */
  public static function CreateItem() {
    Auth::RequireAdmin();

    $item_name = $_POST['name'];
    $item_description = $_POST['description'];
    $item_price = $_POST['price'];
    $item_type = $_POST['type'];
    $item_obj = $_FILES['obj'];
    $item_texture = $_FILES['texture'];
    $public = $_POST['public'];
    $onsale = $_POST['onsale'];
    $creator = $_SESSION['UserID'];

    if (empty($item_name) || empty($item_description) || empty($item_type)) {
      $_SESSION['error'] = "One or more fields is empty!";
      header("Location: /shop/create/");
      exit();
    }

    // check if price is a number
    if (!is_numeric($item_price)) {
      $_SESSION['error'] = "Price must be a number!";
      header("Location: /shop/create/");
      exit();
    }

    if($onsale != 0 && $onsale != 1) {
      $_SESSION['error'] = "Invalid onsale value!";
      header("Location: /shop/create/");
      exit();
    }

    if ($public != 0 && $public != 1) {
      $_SESSION['error'] = "Invalid public value!";
      header("Location: /shop/create/");
      exit();
    }
    
    $obj = pathinfo($item_obj['name']);
    
    if ($obj['extension'] != 'obj') {
      $_SESSION['error'] = "Asset must be OBJ format!";
      header("Location: /shop/create/");
      exit();
    }

    if ($item_texture['type'] != 'image/png') {
      $_SESSION['error'] = "Asset's texture must be PNG format!";
      header("Location: /shop/create/");
      exit();
    }

    // create item

    include($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");

    $sql = "INSERT INTO item (name, descr, price, type, creator, onsale, public, verified) VALUES (:item_name, :item_desc, :item_price, :item_type, :creator, :onsale, :public,  1)";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array(':item_name' => $item_name, ':item_desc' => $item_description, ':item_price' => $item_price, ':item_type' => $item_type, ':creator' => $creator, ':onsale' => $onsale, ':public' => $public));

    $sql = "SELECT id FROM item ORDER BY id DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $id = $stmt->fetch();

    if (!move_uploaded_file($item_obj['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/renderer/res/models/' . $item_type . '/' . $id['id'] . '.obj')) {
      $_SESSION['error'] = "Item was created but object could not be uploaded.";
      header("Location: /shop/create/");
      exit();
    }

    if (!move_uploaded_file($item_texture['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/renderer/res/textures/' . $item_type . '/' . $id['id'] . '.png')) {
      $_SESSION['error'] = "Item was created but texture could not be uploaded.";
      header("Location: /shop/create/");
      exit();
    }
  }
}