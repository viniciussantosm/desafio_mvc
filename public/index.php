<?php
use App\Controller\Auth\LoginController;
use App\Controller\Auth\LogoutController;
use App\Controller\Auth\RegisterController;
use App\Controller\Auth\StoreController;
use App\Controller\Posts\IndexController;
use App\Controller\Users\EditController;
use App\Controller\Users\UpdateController;


ini_set("display_errors", 1);

require_once("vendor/autoload.php");
// require_once("config/Conn.php");

use App\Router\Router;

define("ROOT", __DIR__);
session_start();
$router = new Router;
$router->addRoute("/", IndexController::class);
// Posts Routes
$router->addRoute("/posts", IndexController::class);
$router->addRoute("/posts/index", IndexController::class);
//Auth Routes
$router->addRoute("/auth/index", \App\Controller\Auth\IndexController::class);
$router->addRoute("/auth/login", LoginController::class);
$router->addRoute("/auth/register", RegisterController::class);
$router->addRoute("/auth/store", StoreController::class);
$router->addRoute("/auth/logout", LogoutController::class);
//Users Routes
$router->addRoute("/users/edit", EditController::class);
$router->addRoute("/users/update", UpdateController::class);
$router->addRoute("/users/index", \App\Controller\Users\IndexController::class);
//Categories Routes
$router->addRoute("/categories/index", \App\Controller\Categories\IndexController::class);
$router->addRoute("/categories/create", \App\Controller\Categories\CreateController::class);
$router->addRoute("/categories/store", \App\Controller\Categories\StoreController::class);
//Tags Routes
$router->addRoute("/tags/index", \App\Controller\Tags\IndexController::class);
$router->handle();
return;