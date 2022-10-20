<?php

use brickspace\middleware\Auth;

$name = "Shop";

?>

<style>
  .hidden {
    display: none;
  }
</style>

<div id="loading">

</div>

<div class="card" id="shop">
  <h4>Shop</h4>
  <div class="grid-x grid-margin-x">
    <div class="cell large-2 small-12">
      <?php
      if (Auth::Auth()) {
        if (Auth::Admin()) {
      ?>
          <a href="/shop/create">
            <button class="button full-width">
              <i class="fa fa-plus"></i>
              Create Item (ADMIN)
            </button>
          </a>
        <?php } ?>
        <div class="divider"></div>
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
          <button class="full-width active" id="hats">
            <i class="fas fa-hard-hat"></i>Hats
          </button>
          <button class="full-width" id="faces">
            <i class="fas fa-smile-wink"></i>Faces
          </button>
          <button class="full-width" id="tools">
            <i class="fas fa-hammer"></i>Tools
          </button>
          <button class="full-width" id="shirts">
            <i class="fas fa-tshirt"></i>Shirts
          </button>
          <button class="full-width" id="pants">
            <i class="fas fa-columns"></i>Pants
          </button>
          <?php 
          if(Auth::Admin()) {
          ?>
          <button class="full-width" id="hidden">
            <i class="fas fa-times"></i>Hidden Items
          </button>
          <?php 
          }
          ?>
        </li>
      </ul>
    </div>
    <div class="cell large-10">

      <style>
        .shop-card h4 a {
          color: #fff;
        }

        .shop-card h4 {
          margin: 0;
        }

        .shop-card a {
          margin: 0;
        }
      </style>
      <div id="items"></div>
    </div>
  </div>
</div>
<script>

</script>
<script>
  var selected = "hats";
  $(document).ready(function() {
    loadItems(selected);
    $("#shop-container > button").click(function() {
      $(".active").removeClass("active");
      $(this).addClass("active");
      selected = $(this).attr("id");
      console.log(selected);
      loadItems(selected);
    })
    console.log(selected);
  });

  function loading() {
    $("#shop").addClass("hidden");
    $("#loading").html("<img src='/cdn/img/loading.gif' / style='width: 125px; display: block; margin-left: auto; margin-right: auto; padding: 12px;'><label style='text-align:center; color: #fff;'>Loading...</label>");
  }

  function finishLoading() {
    $("#shop").removeClass("hidden");
    $("#loading").html("");
  }

  function loadItems(selected) {
    loading();
    $("#items").load("/api/shop/load-items", {
      type: selected
    }, function() {
      finishLoading();
    });
  }
</script>