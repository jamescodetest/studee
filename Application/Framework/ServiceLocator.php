<?php
namespace Application\Framework;

class ServiceLocator
{
    private $db;
    private $request;

    public function __construct()
    {
        $this->loadDB();
        $this->loadRequest();
    }

    private function loadDB(): void
    {
        $this->db = new DB();
    }

    public function getDB(): DB
    {
        return $this->db;
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    public function loadRequest()
    {
        $this->request = new Request();
    }
}
