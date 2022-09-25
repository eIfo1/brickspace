<?php

require_once 'vendor/autoload.php';

use brickspace\controller\auth\LogoutController;
use brickspace\controller\guest\LoginController;
use brickspace\controller\guest\RegisterController;
use brickspace\controller\admin\AlertController;
use brickspace\controller\auth\StatusController;
use brickspace\controller\auth\WallController;
use brickspace\controller\BlogController;

require_once("{$_SERVER['DOCUMENT_ROOT']}/router.php");

page('/', 'views/pages/landing.php');
// user controls
page('/login', 'views/pages/login.php');
post('/login', function() {
  LoginController::Login();
});

page('/sign-up', 'views/pages/register.php');
post('/sign-up', function() {
  RegisterController::Register();
});

post('/logout', function() {
  LogoutController::Logout();
});

page('/admin', 'views/pages/admin/dashboard.php');
page('/admin/alert', 'views/pages/admin/alert.php');
post('/admin/alert', function() {
  AlertController::Post();
});
page('/admin/blog', 'views/pages/admin/blog.php');
post('/admin/blog', function () {
  BlogController::Post();
});
// user pages
page('/dashboard', 'views/pages/dashboard.php');
// universal pages
page('/users', 'views/pages/users.php');
page('/users/staff', 'views/pages/staff.php');

page('/users/$page', 'views/pages/users.php');
page('/users/staff/$page', 'views/pages/staff.php');

page('/user/profile/$username', 'views/pages/profile.php');
page('/user/profile', 'views/pages/profile.php');

get('/support', 'views/pages/support.php');

page('/blog', 'views/pages/blog/dashboard.php');
page('/blog/post/$id', 'views/pages/blog/post.php');
// avatar pages
get('/api/avatar/user/$id', 'api/avatar.php');
get('/api/avatar/user', 'api/avatar.php');
get('/api/comments', 'api/load-comments.php');
// post pages
post('/dashboard/wall', function() {
  WallController::Post();
});
post('/dashboard/status', function() {
  StatusController::Update();
});

get('/tests/alert', 'views/tests/alert.php');



// 404
any('/not-found', 'views/errors/404.php');


