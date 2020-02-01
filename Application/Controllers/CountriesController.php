<?php
namespace Application\Controllers;

use Application\Framework\Controller;

class CountriesController extends Controller
{
    public function homeAction()
    {
        $this->getServiceLocator()->getRenderer()->html($this, 'home');
    }
}
