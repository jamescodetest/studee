<?php
namespace Application\Framework;

class ServiceLocator
{
    private $db;
    private $request;

    public function __construct()
    {
        $this->db = $this->loadDB();
        $this->request = $this->loadRequest();
    }

    private function loadDB(): null
    {
        $this->db = new DB();
    }

    public function getDB(): DB
    {
        return $this->db;
    }

    public function getRequest(): Request
    {
        return $this->request();
    }
}
