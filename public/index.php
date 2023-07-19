<?php
use App\Controller\Posts\CreateController;
use App\Controller\Posts\DestroyController;
use App\Controller\Posts\EditController;
use App\Controller\Posts\IndexController;
use App\Controller\Posts\ShowController;
use App\Controller\Posts\StoreController;
use App\Controller\Posts\UpdateController;


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
$router->addRoute("/posts/create", CreateController::class);
$router->addRoute("/posts/store", StoreController::class);
$router->addRoute("/posts/edit", EditController::class);
$router->addRoute("/posts/update", UpdateController::class);
$router->addRoute("/posts/destroy", DestroyController::class);
$router->addRoute("/posts/show", ShowController::class);
//Auth Routes
$router->addRoute("/auth/index", \App\Controller\Auth\IndexController::class);
$router->addRoute("/auth/login", \App\Controller\Auth\LoginController::class);
$router->addRoute("/auth/register", \App\Controller\Auth\RegisterController::class);
$router->addRoute("/auth/store", \App\Controller\Auth\StoreController::class);
$router->addRoute("/auth/logout", \App\Controller\Auth\LogoutController::class);
//Users Routes
$router->addRoute("/users/edit", \App\Controller\Users\EditController::class);
$router->addRoute("/users/update", \App\Controller\Users\UpdateController::class);
$router->addRoute("/users/index", \App\Controller\Users\IndexController::class);
//Categories Routes
$router->addRoute("/categories/index", \App\Controller\Categories\IndexController::class);
$router->addRoute("/categories/create", \App\Controller\Categories\CreateController::class);
$router->addRoute("/categories/store", \App\Controller\Categories\StoreController::class);
$router->addRoute("/categories/edit", \App\Controller\Categories\EditController::class);
$router->addRoute("/categories/update", \App\Controller\Categories\UpdateController::class);
$router->addRoute("/categories/destroy", \App\Controller\Categories\DestroyController::class);
$router->addRoute("/categories/show", \App\Controller\Categories\ShowController::class);
//Tags Routes
$router->addRoute("/tags/index", \App\Controller\Tags\IndexController::class);
$router->addRoute("/tags/create", \App\Controller\Tags\CreateController::class);
$router->addRoute("/tags/store", \App\Controller\Tags\StoreController::class);
$router->addRoute("/tags/edit", \App\Controller\Tags\EditController::class);
$router->addRoute("/tags/update", \App\Controller\Tags\UpdateController::class);
$router->addRoute("/tags/destroy", \App\Controller\Tags\DestroyController::class);
$router->addRoute("/tags/show", \App\Controller\Tags\ShowController::class);
// Dashboard Rotues
$router->addRoute("/dashboard/index", \App\Controller\Dashboard\IndexController::class);
$router->addRoute("/dashboard/categories", \App\Controller\Dashboard\CategoriesDashController::class);
$router->addRoute("/dashboard/tags", \App\Controller\Dashboard\TagsDashController::class);
// Comment Routes
$router->addRoute("/comments/store", \App\Controller\Comments\StoreController::class);

$router->handle();
return;