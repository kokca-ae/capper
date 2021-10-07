<?php

namespace app\base;

class Router {

    use F;
    
    public $routes;

    function __construct() {
        $routesPath = ROOT . '/config/routes.php';
        $this->routes = include($routesPath);
    }

    private function getUri() {
        if (!empty($_SERVER['REQUEST_URI']))
            return trim($_SERVER['REQUEST_URI'], '/');
    }

    public function run() {

        $uri = $this->getUri();
        $result = false;
        
        foreach ($this->routes as $uriPattern => $path) {
            if (preg_match("~^$uriPattern$~", $uri)) {

                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                $params = explode('/', $internalRoute);
                $this->route($params);

                $result = true;
                break;
            }
        }

        if ($result == false) {
            $this->notFound();
        }
    }

}
