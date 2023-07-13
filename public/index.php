<?php

require_once("vendor/autoload.php");
require_once("config/Conn.php");

use App\Router\Router;
use App\Model\Messages\RouteMessages;
use App\Model\Messages\UserMessages;
use App\Model\Session;

define("ROOT", __DIR__);

session_start();
$messageRouter = new RouteMessages();
$messageUser = new UserMessages();
$session = Session::getInstance();
$router = new Router($messageRouter, $messageUser, $session);
$router->init();
$router->dispatch();