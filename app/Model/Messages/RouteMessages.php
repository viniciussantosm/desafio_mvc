<?php

namespace App\Model\Messages;

class RouteMessages extends Messages {

    private static $routeMessages = [
        "posts.index" => "/posts/index",
        "posts" => "/posts",
        "users.index" => "/users/index",
        "users.edit" => "/users/edit/",
    ];

    public function __construct()
    {
    }

    public static function getMessage(string $name, $type = null): string
    {
        if($type) {
            return self::$routeMessages[$type][$name];
        }

        return self::$routeMessages[$name];
    }
}