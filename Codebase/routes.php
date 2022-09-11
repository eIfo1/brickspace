<?php

require_once 'vendor/autoload.php';
use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;

$whoops = new Run();
$whoops->pushHandler(new PrettyPageHandler());
$whoops->register();

require_once("{$_SERVER['DOCUMENT_ROOT']}/router.php");

get('/', 'views/pages/landing.php');
// user controls
get('/login', 'views/pages/login.php');
post('/login', 'controller/guest/login.php');

get('/sign-up', 'views/pages/register.php');
post('/sign-up', 'controller/guest/register.php');

get('/logout', 'controller/auth/logout.php');
// user pages
get('/dashboard', 'views/pages/dashboard.php');
// universal pages
get('/users', 'views/pages/users.php');
get('/users/$page', 'views/pages/users.php');
get('/user/profile/$username', 'views/pages/profile.php');
get('/user/profile', 'views/pages/profile.php');
// avatar pages
get('/api/avatar/user/$id', 'api/avatar.php');
get('/api/avatar/user', 'api/avatar.php');
get('/api/comments', 'api/load-comments.php');
// post pages
post('/dashboard/wall', 'controller/auth/wall.php');



// 404
any('/not-found', 'views/errors/404.php');


