<?php

namespace Stankiewiczpl\PhpRest\Requests;

class DeleteRequest extends RequestAbstract implements RequestInterface
{
    protected $method = 'DELETE';

    public function __construct(array $options = [])
    {
        parent::__construct($options);
        $this->set_option('curl_options', [CURLOPT_POST => false]);
    }
}