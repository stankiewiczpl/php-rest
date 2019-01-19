<?php


namespace Stankiewiczpl\PhpRest\Requests;


class PostRequest extends RequestAbstract implements RequestInterface
{
    protected $method = 'POST';

    public function __construct(array $options = [])
    {
        parent::__construct($options);
        $this->set_option('curl_options', [CURLOPT_POST => true]);
        $this->set_option('curl_options', [CURLOPT_HTTPHEADER => ['Content-Type: application/json']]);
    }
}