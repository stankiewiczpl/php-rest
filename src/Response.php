<?php

namespace Stankiewiczpl\PhpRest;

class Response
{
    protected $response;
    protected $info;

    public function __construct($response, $info)
    {
        $this->response = $response;
        $this->info = $info;
    }

    public function getInfo(string $code = null)
    {
        if ($code)
            return $this->info[$code];

        return $this->info;
    }

    public function getResult()
    {
        return $this->response;
    }
}