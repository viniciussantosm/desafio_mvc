<?php


namespace src\Controller;

abstract class Controller {

    private $notFoundView = "404";

    public function view($viewName)
    {
        $this->validateViewName($viewName);
        $requiredViewName = str_replace(".", "/", $viewName);
        return [
            require_once(__DIR__ . "/../../views/header.php"),
            require_once(__DIR__ . "/../../views/$requiredViewName.php"),
            require_once(__DIR__ . "/../../views/footer.php"),
        ];
    }

    public function validateViewName($viewName)
    {
        if(!is_string($viewName)) {
            return require_once(__DIR__ . "/../../views/$this->notFoundView.php");
        }
    }
}