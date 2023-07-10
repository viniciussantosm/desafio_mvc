<?php


namespace src\Controller;

abstract class Controller {

    public function view($viewName)
    {
        $requiredViewName = str_replace(".", "/", $viewName);
        return require_once(__DIR__ . "/../../views/$requiredViewName.php");
    }
}