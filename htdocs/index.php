<?php

require dirname(__DIR__) . '/init.php';

$router = new \PureFramework\Router();

$router->route('^/logout$', 'logout/index.php');
$router->route('^/login$', 'login/index.php');
$router->route('^/register$', 'register/index.php');
$router->route('^/todos/([0-9a-f-]{36})/toggle$', ['todo_uuid'], 'todos/toggle/index.php');
$router->route('^/todos/([0-9a-f-]{36})/delete$', ['todo_uuid'], 'todos/delete/index.php');
$router->route('^/todos$', 'todos/index.php');
$router->route('^/$', 'home/index.php');

$router->run();
