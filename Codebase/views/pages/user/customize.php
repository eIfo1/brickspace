<?php

use brickspace\controller\auth\UserController;
use brickspace\controller\UsersController;
use brickspace\middleware\Auth;


Auth::Require();

$name = "Customize";
$u = UsersController::GetByID($conn, $_SESSION['UserID']);
$a = UserController::Avatar($conn);
?>
<div class="grid-x grid-margin-x">
  <div class="cell large-3 small-12">
    <h4>
      Customize
    </h4>
    <div class="card">
      <div id="avatar">

      </div>
      <a href="#" id="regen" onclick="renderAvatar()" style="font-size: 40px!important; text-align: right; color: #fff; display: inline-block;">
        <i class="fas fa-redo"></i>
      </a>
    </div>
    <?php
    $colors = [
      "B50600", "C63901", "A8A801", "18AF01", "00D3BE", "000DA0", "A00088",
      "FD0D00", "FF4C01", "FFFF01", "26FC06", "00FFE7", "0014FF", "FF00D9",
      "FD5043", "FF7E47", "E7B541", "5FFF47", "0070fa", "4657FF", "FF48E1",
      "FFB5B6", "FFC8B4", "FFFAB5", "65E72B", "B6FFF4", "B1C2FF", "FFB5F8",
      "C4740C", "ECC494", "7C3C04", "905508", "815117", "944704", "FAD87F",
      "F4F6F7", "C4C6C6", "808282", "626363", "0C1216", "273746", "000000"
    ];
    ?>
    <h4>
      Limb Colors
    </h4>
    <div class="card">
      <fieldset>
        <legend>
          Body Colors
        </legend>
        <div id="limbs" style="overflow:auto;min-height:300px;">
          <div class="body" id="limbs" style="overflow: auto; min-height: 300px; height: 342px;">
            <style>
              .head {
                padding: 25px;
                border: none;

              }

              .torso {
                width: 100%;
                height: 100%;
                margin-top: 2.5px;
                border: none;
                margin-left: -20px;
              }

              .left-arm {
                width: 100%;
                height: 100%;
                margin-top: 2.5px;
                border: none;

              }

              .color button {
                border-radius: 10px;
                border: 1px solid lightgrey;
              }

              .color button:focus {
                outline: none;
              }
            </style>
            <div class="color" style="width: 300px;margin-top:10px;text-align:center;position: relative;">
              <div style=" position: absolute; left: 47.5%; top: 10px;">
                <button class="body-part button tooltip tooltipstered" data-tooltip-content="#colors" id="head_color" part="head" true-name="Head" style="background-color: #edf2f9;padding: 25px;margin-top: -1px;"></button>
              </div>
              <div style=" position: absolute; left: 40.1%; top: 62px;">
                <button class="body-part button tooltip tooltipstered" data-tooltip-content="#colors" id="torso_color" part="torso" true-name="Torso" style="background-color: #000000;padding: 50px;"></button>
              </div>
              <div style=" position: absolute; left: 23.1%; top: 62px;">
                <button id="left_arm_color" class="body-part button tooltip tooltipstered" data-tooltip-content="#colors" part="left_arm" true-name="Left Arm" style="background-color: #edf2f9;padding: 50px;padding-right: 0px;"></button>
              </div>
              <div style=" position: absolute; left: 73.7%; top: 62px;">
                <button class="body-part button tooltip tooltipstered" data-tooltip-content="#colors" id="right_arm_color" part="right_arm" true-name="Right Arm" style="background-color: #edf2f9;padding: 50px;padding-right: 0px;"></button>
              </div>
              <div style="position: absolute;left: 40.2%;top: 165px;">
                <button class="body-part button tooltip tooltipstered" data-tooltip-content="#colors" id="left_leg_color" part="left_leg" true-name="Left Leg" style="background-color: #edf2f9;padding: 50px;padding-right: 0px;padding-left: 47px;"></button>
              </div>
              <div style="position: absolute;left: 57.0%;top: 165px;margin-left: -2px;">
                <button class="body-part button tooltip tooltipstered" data-tooltip-content="#colors" id="right_leg_color" part="right_leg" true-name="Right Leg" style="background-color: #edf2f9;padding: 50px;padding-right: 0px;padding-left: 47px;"></button>
              </div>
            </div>
          </div>
        </div>
      </fieldset>
    </div>
  </div>

  <div class="reveal" id="color-modal" data-reveal="real" data-animation-in="fade-in" data-animation-out="fade-out">
    <form action="/api/account/avatar/color" method="POST">
      <button id="close" type="button" data-close="color-modal" style="float: right; font-size: 40px;">&times;</button>
      <h4>Limb Color</h4>
      <?php $count = 0;
      foreach ($colors as $color) {
        echo "<!-- " . $count % 7 . " -->";
        echo ($count % 7 == 0) ? ((($count == count($colors) - 1) ? "</div>" : ($count == 0)) ? ("<div class='color-holder'>") : ("</div><br><div class='color-holder'>")) : ""; ?>
        <div class="color-btn" color="<?php echo $color ?>" style="float:left;padding: 10px; margin-bottom: 3px;margin-right: 3px;border-radius: 5px;background-color:#<?php echo $color ?>;"></div>

      <?php
        $count++;
      } ?>
  </div>
  </form>
</div>

<div class="messagepop pop card b hidden" style="z-index: 999999999;">
  <div class="top centered">
    <span id="editing-name"></span>
    <button class="close button" style="float:right;margin:0px;float:right;border:none;padding:0;background:none;" onclick="close()"><img id="close" src="/emojis/exit-200.png" height="25"></button>
  </div>
  <div class="body centered">
    <button class="color-btn" style="background-color: #F9EBEA" color="#F9EBEA"></button>
    <button class="color-btn" style="background-color: #F4ECF7" color="#F4ECF7"></button>
    <button class="color-btn" style="background-color: #EBF5FB" color="#EBF5FB"></button>
    <button class="color-btn" style="background-color: #E8F6F3" color="#E8F6F3"></button>
    <button class="color-btn" style="background-color: #EAFAF1" color="#EAFAF1"></button>
    <button class="color-btn" style="background-color: #FEF5E7" color="#FEF5E7"></button>
    <button class="color-btn" style="background-color: #FBEEE6" color="#FBEEE6"></button>
    <button class="color-btn" style="background-color: #FDFEFE" color="#FDFEFE"></button>
    <button class="color-btn" style="background-color: #EAECEE" color="#EAECEE"></button>
    <br><br>
    <button class="color-btn" style="background-color: #CD6155" color="#CD6155"></button>
    <button class="color-btn" style="background-color: #A569BD" color="#A569BD"></button>
    <button class="color-btn" style="background-color: #85C1E9" color="#85C1E9"></button>
    <button class="color-btn" style="background-color: #73C6B6" color="#73C6B6"></button>
    <button class="color-btn" style="background-color: #82E0AA" color="#82E0AA"></button>
    <button class="color-btn" style="background-color: #F8C471" color="#F8C471"></button>
    <button class="color-btn" style="background-color: #E59866" color="#E59866"></button>
    <button class="color-btn" style="background-color: #F4F6F7" color="#F4F6F7"></button>
    <button class="color-btn" style="background-color: #808B96" color="#808B96"></button>
    <br><br>
    <button class="color-btn" style="background-color: #A93226" color="#A93226"></button>
    <button class="color-btn" style="background-color: #7D3C98" color="#7D3C98"></button>
    <button class="color-btn" style="background-color: #2E86C1" color="#2E86C1"></button>
    <button class="color-btn" style="background-color: #138D75" color="#138D75"></button>
    <button class="color-btn" style="background-color: #28B463" color="#28B463"></button>
    <button class="color-btn" style="background-color: #D68910" color="#D68910"></button>
    <button class="color-btn" style="background-color: #BA4A00" color="#BA4A00"></button>
    <button class="color-btn" style="background-color: #D0D3D4" color="#D0D3D4"></button>
    <button class="color-btn" style="background-color: #273746" color="#273746"></button>
    <br><br>
  </div>
</div>

<script src="/cdn/js/api.js"></script>
<script>
  $('.tooltip').tooltipster({
    contentCloning: true,
    trigger: 'click'
  });
  $(function() {

    loading();
    loadAvatar();

    activeLimb = "head";

    $("[part]").click(function() {
      activeLimb = $(this).attr("part");
      console.log(activeLimb);
    })

    $("body").on("click", "[color]", function() {
      console.log($(this).attr("color"));
      loading();
      changeColor(activeLimb, $(this).attr("color"));
      renderAvatar();
      loadAvatar();
    });

  });

  function loading() {
    $("#avatar").html("<img src='/cdn/img/loading.gif' / style='width: 125px; display: block; margin-left: auto; margin-right: auto; padding: 12px;'><label style='text-align:center; color: #fff;'>Loading...</label>");
  }

  function loadAvatar() {
    response("/api/account/avatar").success((data) => {
      console.log(data);
      $("#avatar").html("<img src='/cdn/img/avatar/" + data.avatar + ".png?" + Math.floor(Math.random() * 10000) + "' style='width:100%;' />");
    }).get();
  }

  function renderAvatar() {
    loading();
    console.log(response("/api/renderer/<?php echo $_SESSION['UserID'] ?>").get());
    loadAvatar();
  }

  function changeColor(limb, hex) {
    console.log(limb);
    $("[part=" + limb + "]").css("background-color", "#" + hex);
    response("/api/account/avatar/color").success(function(data) {}).fail(function(error) {
      console.error(error);
    }).post({
      limb: activeLimb,
      hex: hex
    });
  }
</script>