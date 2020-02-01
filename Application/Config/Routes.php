<?php
namespace Application\Config;

abstract class Routes
{
    public static $routes = [
        '/' => 'home@Countries',
        '/search' => 'search@Countries',
    ];
}
