<?php

require("vendor/autoload.php");
require_once __DIR__ . "/../config/router.php";

use src\Controller\{
    PostController,
    UserController,
};

route("/posts", PostController::class);
route("/users", UserController::class);

$action = $_SERVER["REQUEST_URI"];

if($action == "/"){
    header("Location: /posts/index");
}
$method = $_SERVER["REQUEST_METHOD"];
dispatch($action, $method);