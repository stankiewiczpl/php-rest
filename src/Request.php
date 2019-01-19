<?php

namespace Stankiewiczpl\PhpRest;

use Stankiewiczpl\PhpRest\Exceptions\InvalidRequestException;
use Stankiewiczpl\PhpRest\Requests\RequestInterface;

class Request
{
    public function getInstance(string $method,array $options = []): RequestInterface
    {
        $requestClass = 'Stankiewiczpl\\PhpRest\\Requests\\' . ucfirst(strtolower($method)) . 'Request';

        if (!class_exists($requestClass)) {
            throw new InvalidRequestException();
        }

        return new $requestClass($options);

    }
}