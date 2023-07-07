<?php

declare(strict_types=1);

/**
 * Holds the registered routes
 *
 * @var array $routes
 */
$routes = [];

/**
 * Register a new route
 *
 * @param $action string
 * @param \Closure $callback Called when current URL matches provided action
 */
function route($action, $controller)
{
    global $routes;
    $action = trim($action, '/');
    $routes[$action] = $controller;
}

/**
 * Dispatch the router
 *
 * @param $action string
 */
function dispatch($action, $method)
{
    global $routes;
    var_dump($routes);
    $action = trim($action, '/');
    $action = explode("/", $action);
    var_dump(count($action));
    
}