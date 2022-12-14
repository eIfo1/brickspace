<?php

use brickspace\middleware\Auth;

Auth::RequireAdmin();

$name = "Create Item (Admin)";

?>

<div class="grid-x">
  <div class="cell large-3 small-12"></div>
  <div class="cell auto">
    <h4>Create Item</h4>
    <div class="card">
      <form action="" enctype="multipart/form-data" method="POST">
        <input type="text" name="name" placeholder="Item Name...">
        <textarea name="description" cols="30" rows="10" placeholder="Item Description..."></textarea>
        <input type="number" name="price" placeholder="Item Price...">
        <label for="type">
          Item Type
        </label>
        <select name="type" id="type">
          <option value="hats" selected>Hat</option>
          <option value="tools">Tool</option>
        </select>
        <label for="public">
          Item Visibility
        </label>
        <select name="public" id="public">
          <option value="1" selected>Public</option>
          <option value="0">Hidden</option>
        </select>
        <label for="onsale">
          Is Item Onsale
        </label>
        <select name="onsale" id="onsale">
          <option value="1" selected>Yes</option>
          <option value="0">No</option>
        </select>
        <label for="obj">
          Model
        </label>
        <input type="file" name="obj" id="obj">
        <label for="texture">
          Texture
        </label>
        <input type="file" name="texture" id="texture">
        <button class="button">
          Submit
        </button>
      </form>
    </div>
  </div>
  <div class="cell large-3 small-12"></div>
</div>