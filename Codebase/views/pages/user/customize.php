<?php

use brickspace\controller\auth\UserController;
use brickspace\controller\UsersController;
use brickspace\middleware\Auth;


Auth::Require();

$name = "Customize";
$u = UsersController::GetByID($conn, $_SESSION['UserID']);
$a = UserController::Avatar($conn);
?>

<div class="hidden">
  <div id="colors" class="color-card">
    <div class="color-holder">
      <div class="color-btn" color="B50600" style="float:left;padding: 10px; margin-bottom: 3px;margin-right: 3px;border-radius: 5px;background-color:#B50600;"></div>
      <div class="color-btn" color="C63901" style="float:left;padding: 10px; margin-bottom: 3px;margin-right: 3px;border-radius: 5px;background-color:#C63901;"></div>
      <div class="color-btn" color="A8A801" style="float:left;padding: 10px; margin-bottom: 3px;margin-right: 3px;border-radius: 5px;background-color:#A8A801;"></div>
      <div class="color-btn" color="18AF01" style="float:left;padding: 10px; margin-bottom: 3px;margin-right: 3px;border-radius: 5px;background-color:#18AF01;"></div>
      <div class="color-btn" color="00D3BE" style="float:left;padding: 10px; margin-bottom: 3px;margin-right: 3px;border-radius: 5px;background-color:#00D3BE;"></div>
      <div class="color-btn" color="000DA0" style="float:left;padding: 10px; margin-bottom: 3px;margin-right: 3px;border-radius: 5px;background-color:#000DA0;"></div>
      <div class="color-btn" color="A00088" style="float:left;padding: 10px; margin-bottom: 3px;margin-right: 3px;border-radius: 5px;background-color:#A00088;"></div>
    </div>
    <div class="color-holder">
      <div class="color-btn" color="FD0D00" style="float:left;padding: 10px; margin-bottom: 3px;margin-right: 3px;border-radius: 5px;background-color:#FD0D00;"></div>
      <div class="color-btn" color="FF4C01" style="float:left;padding: 10px; margin-bottom: 3px;margin-right: 3px;border-radius: 5px;background-color:#FF4C01;"></div>
      <div class="color-btn" color="FFFF01" style="float:left;padding: 10px; margin-bottom: 3px;margin-right: 3px;border-radius: 5px;background-color:#FFFF01;"></div>
      <div class="color-btn" color="26FC06" style="float:left;padding: 10px; margin-bottom: 3px;margin-right: 3px;border-radius: 5px;background-color:#26FC06;"></div>
      <div class="color-btn" color="00FFE7" style="float:left;padding: 10px; margin-bottom: 3px;margin-right: 3px;border-radius: 5px;background-color:#00FFE7;"></div>
      <div class="color-btn" color="0014FF" style="float:left;padding: 10px; margin-bottom: 3px;margin-right: 3px;border-radius: 5px;background-color:#0014FF;"></div>
      <div class="color-btn" color="FF00D9" style="float:left;padding: 10px; margin-bottom: 3px;margin-right: 3px;border-radius: 5px;background-color:#FF00D9;"></div>
    </div>
    <div class="color-holder">
      <div class="color-btn" color="FD5043" style="float:left;padding: 10px; margin-bottom: 3px;margin-right: 3px;border-radius: 5px;background-color:#FD5043;"></div>
      <div class="color-btn" color="FF7E47" style="float:left;padding: 10px; margin-bottom: 3px;margin-right: 3px;border-radius: 5px;background-color:#FF7E47;"></div>
      <div class="color-btn" color="FFFF47" style="float:left;padding: 10px; margin-bottom: 3px;margin-right: 3px;border-radius: 5px;background-color:#FFFF47;"></div>
      <div class="color-btn" color="5FFF47" style="float:left;padding: 10px; margin-bottom: 3px;margin-right: 3px;border-radius: 5px;background-color:#5FFF47;"></div>
      <div class="color-btn" color="47FEF0" style="float:left;padding: 10px; margin-bottom: 3px;margin-right: 3px;border-radius: 5px;background-color:#47FEF0;"></div>
      <div class="color-btn" color="4657FF" style="float:left;padding: 10px; margin-bottom: 3px;margin-right: 3px;border-radius: 5px;background-color:#4657FF;"></div>
      <div class="color-btn" color="FF48E1" style="float:left;padding: 10px; margin-bottom: 3px;margin-right: 3px;border-radius: 5px;background-color:#FF48E1;"></div>
    </div>
    <div class="color-holder">
      <div class="color-btn" color="FFB5B6" style="float:left;padding: 10px; margin-bottom: 3px;margin-right: 3px;border-radius: 5px;background-color:#FFB5B6;"></div>
      <div class="color-btn" color="FFC8B4" style="float:left;padding: 10px; margin-bottom: 3px;margin-right: 3px;border-radius: 5px;background-color:#FFC8B4;"></div>
      <div class="color-btn" color="FFFAB5" style="float:left;padding: 10px; margin-bottom: 3px;margin-right: 3px;border-radius: 5px;background-color:#FFFAB5;"></div>
      <div class="color-btn" color="C3FFB5" style="float:left;padding: 10px; margin-bottom: 3px;margin-right: 3px;border-radius: 5px;background-color:#C3FFB5;"></div>
      <div class="color-btn" color="B6FFF4" style="float:left;padding: 10px; margin-bottom: 3px;margin-right: 3px;border-radius: 5px;background-color:#B6FFF4;"></div>
      <div class="color-btn" color="B1C2FF" style="float:left;padding: 10px; margin-bottom: 3px;margin-right: 3px;border-radius: 5px;background-color:#B1C2FF;"></div>
      <div class="color-btn" color="FFB5F8" style="float:left;padding: 10px; margin-bottom: 3px;margin-right: 3px;border-radius: 5px;background-color:#FFB5F8;"></div>
    </div>
    <div class="color-holder">
      <div class="color-btn" color="F4F6F7" style="float:left;padding: 10px; margin-bottom: 3px;margin-right: 3px;border-radius: 5px;background-color:#F4F6F7;"></div>
      <div class="color-btn" color="C4C6C6" style="float:left;padding: 10px; margin-bottom: 3px;margin-right: 3px;border-radius: 5px;background-color:#C4C6C6;"></div>
      <div class="color-btn" color="808282" style="float:left;padding: 10px; margin-bottom: 3px;margin-right: 3px;border-radius: 5px;background-color:#808282;"></div>
      <div class="color-btn" color="626363" style="float:left;padding: 10px; margin-bottom: 3px;margin-right: 3px;border-radius: 5px;background-color:#626363;"></div>
      <div class="color-btn" color="0C1216" style="float:left;padding: 10px; margin-bottom: 3px;margin-right: 3px;border-radius: 5px;background-color:#0C1216;"></div>
      <div class="color-btn" color="273746" style="float:left;padding: 10px; margin-bottom: 3px;margin-right: 3px;border-radius: 5px;background-color:#273746;"></div>
      <div class="color-btn" color="000000" style="float:left;padding: 10px; margin-bottom: 3px;margin-right: 3px;border-radius: 5px;background-color:#000000;"></div>
    </div>
  </div>
</div>
<div class="grid-x grid-margin-x">
  <div class="cell large-3 small-12">
    <h4>
      Customize
    </h4>
    <div class="card">
      <div id="avatar">

      </div>
      <a id="regen" onclick="renderAvatar()" style="font-size: 40px!important; text-align: right; color: #fff; display: inline-block;">
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
                <button class="body-part button color-tooltip" data-tooltip-content="#colors" id="head_color" part="head" true-name="Head" style="background-color: #<?php echo $a['head_color'] ?>;padding: 25px;margin-top: -1px;"></button>
              </div>
              <div style=" position: absolute; left: 40.1%; top: 62px;">
                <button class="body-part button color-tooltip" data-tooltip-content="#colors" id="torso_color" part="torso" true-name="Torso" style="background-color: #<?php echo $a['torso_color'] ?>;padding: 50px;"></button>
              </div>
              <div style=" position: absolute; left: 23.1%; top: 62px;">
                <button id="left_arm_color" class="body-part button color-tooltip" data-tooltip-content="#colors" part="left_arm" true-name="Left Arm" style="background-color: #<?php echo $a['left_arm_color'] ?>;padding: 50px;padding-right: 0px;""></button>
              </div>
              <div style=" position: absolute; left: 73.7%; top: 62px;">
                  <button class="body-part button color-tooltip"" data-tooltip-content=" #colors" id="right_arm_color" part="right_arm" true-name="Right Arm" style="background-color: #<?php echo $a['right_arm_color'] ?>;padding: 50px;padding-right: 0px;"></button>
              </div>
              <div style="position: absolute;left: 40.2%;top: 165px;">
                <button class="body-part button color-tooltip" data-tooltip-content="#colors" id="left_leg_color" part="left_leg" true-name="Left Leg" style="background-color: #<?php echo $a['left_leg_color'] ?>;padding: 50px;padding-right: 0px;padding-left: 47px;"></button>
              </div>
              <div style="position: absolute;left: 57.0%;top: 165px;margin-left: -2px;">
                <button class="body-part button color-tooltip" data-tooltip-content="#colors" id="right_leg_color" part="right_leg" true-name="Right Leg" style="background-color: #<?php echo $a['right_leg_color'] ?>;padding: 50px;padding-right: 0px;padding-left: 47px;"></button>
              </div>
            </div>
          </div>
        </div>
      </fieldset>
    </div>
  </div>
</div>


<script src="/cdn/js/api.js"></script>
<script>
  $(function() {
    $('.color-tooltip').tooltipster({
      theme: "no-padding",
      contentCloning: true,
      time: 0,
      arrow: false,
      trigger: 'click',
      interactive: true,
      side: 'left',
      animation: 'grow',
    });
  });
</script>
<script>
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
    });

  });

  function loading() {
    $("#avatar").html("<img src='/cdn/img/loading.gif' / style='width: 125px; display: block; margin-left: auto; margin-right: auto; padding: 12px;'><label style='text-align:center; color: #fff;'>Loading...</label>");
  }

  function loadAvatar() {
    response("/api/account/avatar").success((data) => {
      wait(0.5);
      console.log(data);
      $("#avatar").html("<img src='/cdn/img/avatar/" + data.avatar + ".png?" + Math.floor(Math.random() * 10000000) + "' style='width:100%;' />");
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