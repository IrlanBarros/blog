<?php

namespace App\Application\Exception\Post;

use Exception;

class EmptyPostFieldException extends Exception
{
    public function __construct(string $field)
    {
        parent::__construct("The post field '{$field}' cannot be empty.");
    }
}