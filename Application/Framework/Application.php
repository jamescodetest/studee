<?php
namespace Application\Framework;

class Application
{
    private $serviceLocator;

    public function __construct(ServiceLocator $_serviceLocator)
    {
        $this->serviceLocator = $_serviceLocator;
    }

    public function run()
    {
        $route = $this->detectRoute();

        $expectedController = '\\Application\\Controllers\\' . $route->controller . 'Controller';
        $expectedAction = $route->action . 'Action';

        if (class_exists($neededController)) {
            $curController = new $expectedController($this->serviceLocator);
        } else {
            throw new \Exception('Controller ' . $expectedController . ' not found');
        }

        if (method_exists($curController, $expectedAction)) {
            $curController->$expectedAction();
        }
    }

    private function detectRoute(): RouteModel
    {
        $req = $this->serviceLocator->getRequest();

        $currentRoute = ($req->getUri != '') ? '404' : 'home';
        foreach (Routes::$routes as $route => $rule) {
            if (preg_match('#^/?' . $route . '/?$#', $req->getUri)) {
                $currentRoute = $route;
                break;
            }
        }

        $routeParts = explode('@', Routes::$routes[$currentRoute]);

        $route = new RouteModel($routeParts[0] ?? '', $routeParts[1] ?? '');

        return $route;
    }
}
