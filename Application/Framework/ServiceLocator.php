<?php
namespace Application\Framework;

class ServiceLocator
{
    private $db;
    private $request;
    private $renderer;

    public function __construct()
    {
        $this->loadDB();
        $this->loadRequest();
        $this->loadRenderer();
    }

    private function loadDB(): void
    {
        $this->db = new DB();
        $this->db->connect();
    }

    public function getDB(): DB
    {
        return $this->db;
    }

    private function loadRequest()
    {
        $this->request = new Request();
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    private function loadRenderer()
    {
        $this->renderer = new Renderer();
    }

    public function getRenderer(): Renderer
    {
        return $this->renderer;
    }
}
