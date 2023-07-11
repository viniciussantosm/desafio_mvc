<?php

require("vendor/autoload.php");
require("config/config.ini.php");
require("config/Conn.php");

use src\Router\Router;
use config\Database;

define("ROOT", __DIR__);

$conn = new Database(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
$link = $conn->connect();

$router = new Router();
$router->init();
$router->dispatch();