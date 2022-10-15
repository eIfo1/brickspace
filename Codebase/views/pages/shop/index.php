<?php

use brickspace\middleware\Auth;

$name = "Shop";

?>

<div class="card">
  <h4>Market</h4>
  <div class="grid-x grid-margin-x">
    <div class="cell large-2 small-12">
      <?php
      if (Auth::Auth()) {
      ?>
        <a href="/shop/create">
          <button class="button full-width">
            <i class="fa fa-plus"></i>
            Create Item
          </button>
        </a>
      <?php
      }
      ?>
      <ul class="vertical-menu">
        <li class="shop-button" id="shop-container">
          <button class="full-width active">
            <i class="fas fa-hard-hat"></i>Hats
          </button>
          <button class="full-width">
            <i class="fas fa-smile-wink"></i>Faces
          </button>
          <button class="full-width">
            <i class="fas fa-hammer"></i>Tools
          </button>
          <button class="full-width">
            <i class="fas fa-tshirt"></i>Clothes
          </button>
        </li>
      </ul>
    </div>
    <div class="cell large-10">
      <div class="grid-x">
        <div id="items"></div>
      </div>
    </div>
  </div>
</div>
<script>
  // active button tomfoolery
  var shopContainer = document.getElementById("shop-container");

  var buttons = shopContainer.getElementsByClassName("full-width");

  for (var i = 0; i < buttons.length; i++) {
    buttons[i].addEventListener("click", function() {
      var current = document.getElementsByClassName("active");
      current[0].className = current[0].className.replace(" active", "");
      this.className += " active";
    });
  }
</script>