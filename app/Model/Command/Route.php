<?php

namespace App\Model\Command;

use App\Model\Messages\Messages;
use App\Model\Session;
use App\Router\Router;
use Exception;

class Route {
    private $route;
    private $controller;
    protected  $next;

    public function __construct(string $route, string $controller, Router $router)
    {
        $this->route = $route;
        $this->controller = new $controller($router);
    }


    public function handle($uri)
    {
        if ($uri == $this->route) {
            return $this->execute();
        }

        if($this->checkForEdit($uri)) {
            return false;
        }
        
        if ($this->getNext()) {
            return $this->getNext()->handle($uri);
        }

        if($this->checkForStaticFile(ROOT . $uri)) {
            return false;
        }
        var_dump($this->controller);
        
        throw new Exception("404");
    }

    protected function execute() {
        return $this->controller->execute();
    }

	/**
	 * @return Route
	 */
	public function getNext() {
		return $this->next;
	}
	
	/**
	 * @param Route $next 
	 * @return self
	 */
	public function setNext(Route $next): self {
		$this->next = $next;
		return $this;
	}

    public function checkForStaticFile($filePath)
    {
        if (file_exists($filePath)) {
            $this->setContentType($filePath);
            $this->showFileContent($filePath);
            
            return true;
        }
    }

    public function showFileContent($filePath)
    {
        $fh = fopen($filePath, 'r');
        fpassthru($fh);
        fclose($fh);
    }

    public function setContentType($filePath)
    {
        if(strpos($filePath, ".css")) {
            header('Content-Type: text/css');
            return true;
        }

        header('Content-Type: '.mime_content_type($filePath));
        return true;
    }

    public function checkForEdit($uri)
    {
        $explodedUri = explode("/", trim($uri, "/"));
        if(!array_key_exists(1, $explodedUri)) {
            return false;
        }
        
        if(!$explodedUri[1] == "edit") {
            return false;
        }
        array_pop($explodedUri);
        $explodedUri = implode("/", $explodedUri);
        if(trim($this->route, "/") == $explodedUri) {
            return $this->execute();
        }
    }
}