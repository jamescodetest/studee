<?php
namespace Application\Framework;

class Controller
{
    private $serviceLocator;
    public $scope;

    public function __construct(ServiceLocator $_serviceLocator)
    {
        $this->serviceLocator = $_serviceLocator;
    }

    public function getServiceLocator(): ServiceLocator
    {
        return $this->serviceLocator;
    }
}
