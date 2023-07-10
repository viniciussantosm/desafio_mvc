<?php

require("vendor/autoload.php");

use src\Router\Router;

$router = new Router();
$router->init();
$router->dispatch();