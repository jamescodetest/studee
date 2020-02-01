<?php
namespace Application\Framework;

class Request
{
    private $uri;
    private $postData = [];

    public function __construct()
    {
        $this->uri = $_SERVER['REQUEST_URI'];

        if ($this->isPost()) {
            $this->postData = $_POST;
        }
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function isPost(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    public function getPost(string $_key, string $_defaultValue = ''): string
    {
        return $this->postData[$_key] ?? $_defaultValue;
    }
}
