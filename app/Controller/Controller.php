<?php


namespace App\Controller;

use App\Model\Messages\Messages;
use App\Model\Session;

abstract class Controller {

    private $notFoundView = "404";
    protected Messages $routerMessager;
    protected Messages $userMessager;
    protected Session $session;

    public function __construct(Messages $routeMessager, Messages $userMessager, Session $session)
    {
        $this->routerMessager = $routeMessager;
        $this->userMessager = $userMessager;
        $this->session = $session;
    }

    public function view($viewName, $data = [])
    {
        $this->validateViewName($viewName);
        $requiredViewName = str_replace(".", "/", $viewName);
        return [
            require_once(dirname(__DIR__, 2) . "/views/header.php"),
            require_once(dirname(__DIR__, 2) . "/views/$requiredViewName.php"),
            require_once(dirname(__DIR__, 2) . "/views/footer.php"),
            $data,
        ];
    }

    public function validateViewName($viewName)
    {
        if(!is_string($viewName)) {
            return require_once(dirname(__DIR__, 2) . "/views/$this->notFoundView.php");
        }
    }

    // abstract protected function isAllowed():bool;
}