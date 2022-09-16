<?php

require_once 'vendor/autoload.php';

require_once("{$_SERVER['DOCUMENT_ROOT']}/router.php");

page('/', 'views/pages/landing.php');
// user controls
page('/login', 'views/pages/login.php');
post('/login', 'controller/guest/login.php');

page('/sign-up', 'views/pages/register.php');
post('/sign-up', 'controller/guest/register.php');

get('/logout', 'controller/auth/logout.php');
// user pages
page('/dashboard', 'views/pages/dashboard.php');
// universal pages
page('/users', 'views/pages/users.php');
page('/users/$page', 'views/pages/users.php');
page('/user/profile/$username', 'views/pages/profile.php');
page('/user/profile', 'views/pages/profile.php');

get('/support', 'views/pages/support.php');
// avatar pages
get('/api/avatar/user/$id', 'api/avatar.php');
get('/api/avatar/user', 'api/avatar.php');
get('/api/comments', 'api/load-comments.php');
// post pages
post('/dashboard/wall', 'controller/auth/wall.php');



// 404
any('/not-found', 'views/errors/404.php');


