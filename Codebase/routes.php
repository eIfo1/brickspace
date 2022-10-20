<?php

require_once 'vendor/autoload.php';

use brickspace\controller\auth\LogoutController;
use brickspace\controller\guest\LoginController;
use brickspace\controller\guest\RegisterController;
use brickspace\controller\admin\AlertController;
use brickspace\controller\auth\StatusController;
use brickspace\controller\auth\UserController;
use brickspace\controller\auth\WallController;
use brickspace\controller\BlogController;
use brickspace\controller\MarketController;

require_once("{$_SERVER['DOCUMENT_ROOT']}/router.php");

get('/', 'views/pages/landing.php');
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
page('/admin/faq', 'views/pages/admin/faq.php');
page('/admin/alert', 'views/pages/admin/alert.php');
post('/admin/alert', function() {
  AlertController::Post();
});
page('/admin/blog', 'views/pages/admin/blog.php');
post('/admin/blog', function () {
  BlogController::Post();
});
// user pages
page('/dashboard', 'views/pages/user/dashboard.php');
page('/account/notifications', 'views/pages/placeholder/development.php');
page('/account/currency', 'views/pages/placeholder/development.php');
page('/account/friends/requests', 'views/pages/placeholder/development.php');
page('/account/inbox', 'views/pages/placeholder/development.php');
page('/account/settings', 'views/pages/placeholder/development.php');
page('/account/customize', 'views/pages/user/customize.php');
post('/account/customize', function() {
  UserController::Edit_Avatar();
});
// forum 

page('/forum', 'views/pages/forum/index.php');
page('/forum/category/$id', 'views/pages/forum/category.php');

// universal pages
page('/users', 'views/pages/users.php');
page('/users/staff', 'views/pages/staff.php');

page('/users/$page', 'views/pages/users.php');
page('/users/staff/$page', 'views/pages/staff.php');

page('/user/profile/$username', 'views/pages/profile.php');
page('/user/profile', 'views/pages/profile.php');

page('/shop', 'views/pages/shop/index.php');
page('/shop/item/$id', 'views/pages/shop/item.php');
page('/shop/create', 'views/pages/shop/create.php');
post('/shop/create', function () {
  MarketController::CreateItem();
});

get('/site/donate', 'views/pages/support.php');

page('/updates', 'views/pages/blog/dashboard.php');
page('/updates/post/$id', 'views/pages/blog/post.php');
page('/updates/edit/$id', 'views/pages/blog/edit.php');
post('/updates/edit/$id', function() {
  BlogController::Edit();
});
post('/blog/delete/$id', function () {
  BlogController::Delete();
});
// api routes pages
get('/api/account/avatar', 'api/avatar/avatar.php');
post('/api/account/avatar/color', 'api/avatar/color.php');
get('/api/account/avatar/color', 'api/avatar/color.php');
get('/api/comments', 'api/load-comments.php');

get('/api/renderer/$id', 'renderer/render.php');
get('/api/renderer/shop/$id', 'renderer/shop_render.php');

post('/api/shop/load-items', 'api/shop/load-items.php');

// post pages
post('/dashboard/wall', function() {
  WallController::Post();
});
post('/dashboard/status', function() {
  StatusController::Update();
});

page('/banned', 'views/pages/user/banned.php');



// 404
page('/not-found', 'views/errors/404.php');


