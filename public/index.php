<?php

require("vendor/autoload.php");
require("config/config.ini.php");
require("config/Conn.php");

use src\Router\Router;
use config\Database;

define("ROOT", __DIR__);

session_start();
$router = new Router();
$router->init();
$router->dispatch();