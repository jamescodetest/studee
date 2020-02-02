<?php
namespace Application\Framework;

abstract class Validator
{
    protected $errors = [];

    public function getErrors(): array
    {
        return $this->errors;
    }

    abstract public function validate(): bool;
}
