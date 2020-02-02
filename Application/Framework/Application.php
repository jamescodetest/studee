<?php
namespace Application\Framework;

use Application\Config\Routes;

class Application
{
    private $serviceLocator;

    public function __construct(ServiceLocator $_serviceLocator)
    {
        $this->serviceLocator = $_serviceLocator;
    }

    public function run()
    {
        $this->initDB();

        $route = $this->detectRoute();

        $expectedController = '\\Application\\Controllers\\' . $route->controller . 'Controller';
        $expectedAction = $route->action . 'Action';

        if (class_exists($expectedController)) {
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

        $currentRoute = ($req->getUri() != '') ? '404' : 'home';
        foreach (Routes::$routes as $route => $rule) {
            if (preg_match('#^' . $route . '/?$#', $req->getUri())) {
                $currentRoute = $route;
                break;
            }
        }

        $routeParts = explode('@', Routes::$routes[$currentRoute]);

        $route = new RouteModel($routeParts[0] ?? '', $routeParts[1] ?? '');

        return $route;
    }

    private function initDB()
    {
        $sql = 'SELECT table_name FROM information_schema.tables WHERE table_name IN ("countries", "countries_timezones", "countries_currencies")';
        $tables = $this->serviceLocator->getDB()->getAll($sql);

        $existingTables = array_column($tables, 'table_name');

        if (!in_array('countries', $existingTables)) {
            $sql = 'CREATE TABLE `countries` (
                      `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                      `country_name` varchar(255) CHARACTER SET latin1 NOT NULL,
                      `country_code` varchar(2) NOT NULL,
                      `capital_city` varchar(255) NOT NULL,
                      `primary_language` varchar(255) NOT NULL,
                      `international_dialing_code` varchar(45) NOT NULL,
                      `region` varchar(255) NOT NULL,
                      `flag_url` varchar(255) NOT NULL,
                      PRIMARY KEY (`id`),
                      UNIQUE KEY `country_name_UNIQUE` (`country_name`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8';
            $this->serviceLocator->getDB()->execute($sql);
        }

        if (!in_array('countries_currencies', $existingTables)) {
            $sql = 'CREATE TABLE `countries_currencies` (
                      `country_id` int(11) NOT NULL,
                      `currency_code` varchar(45) NOT NULL,
                      PRIMARY KEY (`country_id`,`currency_code`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8';
            $this->serviceLocator->getDB()->execute($sql);
        }

        if (!in_array('countries_timezones', $existingTables)) {
            $sql = 'CREATE TABLE `countries_timezones` (
                      `country_id` int(11) NOT NULL,
                      `timezone` varchar(45) NOT NULL,
                      PRIMARY KEY (`country_id`,`timezone`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8';
            $this->serviceLocator->getDB()->execute($sql);
        }
    }
}
