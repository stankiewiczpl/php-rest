<?php

namespace Stankiewiczpl\PhpRest\Requests;

class GetRequest extends RequestAbstract implements RequestInterface
{
    protected $method = 'GET';

    public function __construct(array $options = [])
    {
        parent::__construct($options);
        $this->set_option('curl_options', [CURLOPT_POST => false]);
    }
}