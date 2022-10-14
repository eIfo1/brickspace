<?php

use brickspace\middleware\Auth;
use brickspace\controller\UsersController;

Auth::Deny();
$name = "Landing";
?>
<div class="card">
  <h1 class="text-center">
    BrickSpace
  </h1>
  <p class="text-center">
    <strong>For users, by users.</strong>
  </p>
</div>
<div class="grid-x">
  <div class="small-12 large-4">
    <div class="card">
      <p>BrickSpace has a growing userbase of <strong><?php echo UsersController::Count($conn) ?>+ users</strong>.</p>
    </div>
    <div class="card">
      <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Minus, ab alias! Dolores, doloremque provident quia laboriosam tenetur voluptatum eos, sapiente tempore laborum nihil optio voluptas ratione eius molestiae aut fuga. </p>
      <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Minus, ab alias! Dolores, doloremque provident quia laboriosam tenetur voluptatum eos, sapiente tempore laborum nihil optio voluptas ratione eius molestiae aut fuga. </p>
    </div>
    <div class="card">
      <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Minus, ab alias! Dolores, doloremque provident quia laboriosam tenetur voluptatum eos, sapiente tempore laborum nihil optio voluptas ratione eius molestiae aut fuga. </p>
      <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Minus, ab alias! Dolores, doloremque provident quia laboriosam tenetur voluptatum eos, sapiente tempore laborum nihil optio voluptas ratione eius molestiae aut fuga. </p>
    </div>
  </div>
  <div class="small-12 large-4">
    <div class="card">
      <h1 class="center">
        Lorem Ipsum
      </h1>
    </div>
    <div class="card">
      <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora ipsa quam incidunt perspiciatis unde ducimus aliquam asperiores blanditiis laboriosam ut. Harum, magni assumenda adipisci dicta numquam illo ab aliquam vitae. </p>
    </div>
    <div class="card">
      <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora ipsa quam incidunt perspiciatis unde ducimus aliquam asperiores blanditiis laboriosam ut. Harum, magni assumenda adipisci dicta numquam illo ab aliquam vitae. </p>
    </div>
    <div class="card">
      <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora ipsa quam incidunt perspiciatis unde ducimus aliquam asperiores blanditiis laboriosam ut. Harum, magni assumenda adipisci dicta numquam illo ab aliquam vitae. </p>
    </div>
    <div class="card">
      <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora ipsa quam incidunt perspiciatis unde ducimus aliquam asperiores blanditiis laboriosam ut. Harum, magni assumenda adipisci dicta numquam illo ab aliquam vitae. </p>
    </div>
  </div>
  <div class="small-12 large-4">
    <div class="card">
      <h1 class="center">
        Lorem Ipsum
      </h1>
    </div>
    <div class="card">
      <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora ipsa quam incidunt perspiciatis unde ducimus aliquam asperiores blanditiis laboriosam ut. Harum, magni assumenda adipisci dicta numquam illo ab aliquam vitae. </p>
    </div>
    <div class="card">
      <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora ipsa quam incidunt perspiciatis unde ducimus aliquam asperiores blanditiis laboriosam ut. Harum, magni assumenda adipisci dicta numquam illo ab aliquam vitae. </p>
    </div>
    <div class="card">
      <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora ipsa quam incidunt perspiciatis unde ducimus aliquam asperiores blanditiis laboriosam ut. Harum, magni assumenda adipisci dicta numquam illo ab aliquam vitae. </p>
    </div>
  </div>
</div>
