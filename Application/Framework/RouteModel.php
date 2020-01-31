<?php
namespace Application\Framework;

class RouteModel
{
    public $action;
    public $controller;

    public function __construct(string $_action, string $_controller)
    {
        $this->action = $_action;
        $this->controller = $_controller;
    }
}
