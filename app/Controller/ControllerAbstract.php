<?php


namespace App\Controller;
use App\Model\Command\Command;
use App\Router\Router;

abstract class ControllerAbstract implements Command {

    private Router $router;

    public function __construct(
        Router $router
    ) {
        $this->router = $router;
    }

    public function getParams() {
        return array_merge(
            $_GET ?? [],
            $_POST ?? [],
            $_FILES ?? [],
        );
    }

    public function getParam($key) {
        return $this->getParams()[$key] ?? null; 
    }

    public function view($viewName, $data = [])
    {
        $requiredViewName = str_replace(".", "/", $viewName);
        $server["host"] = $_SERVER["HTTP_HOST"];
        return [
            require_once(dirname(ROOT) . "/views/header.php"),
            require_once(dirname(ROOT) . "/views/$requiredViewName.php"),
            require_once(dirname(ROOT) . "/views/footer.php"),
            $data,
            $server
        ];
    }

	/**
	 * @return Router
	 */
	public function getRouter(): Router {
		return $this->router;
	}
	
	/**
	 * @param Router $router 
	 * @return self
	 */
	public function setRouter(Router $router): self {
		$this->router = $router;
		return $this;
	}
}