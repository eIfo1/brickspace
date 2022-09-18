<?php

require_once 'vendor/autoload.php';

use brickspace\controller\auth\LogoutController;

require_once("{$_SERVER['DOCUMENT_ROOT']}/router.php");

page('/', 'views/pages/landing.php');
// user controls
page('/login', 'views/pages/login.php');
post('/login', 'app/controller/guest/login.php');

page('/sign-up', 'views/pages/register.php');
post('/sign-up', 'app/controller/guest/register.php');

post('/logout', function() {
  LogoutController::Logout();
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
// avatar pages
get('/api/avatar/user/$id', 'api/avatar.php');
get('/api/avatar/user', 'api/avatar.php');
get('/api/comments', 'api/load-comments.php');
// post pages
post('/dashboard/wall', 'app/controller/auth/wall.php');

get('/tests/alert', 'views/tests/alert.php');



// 404
any('/not-found', 'views/errors/404.php');


