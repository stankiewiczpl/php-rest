<?php

namespace Stankiewiczpl\PhpRest;

use Stankiewiczpl\PhpRest\Requests\RequestInterface;

class Client
{
    public $request;


    public function execute(RequestInterface $request): Response
    {
        $ch = curl_init();
        curl_setopt_array($ch, $request->get_option('curl_options'));
        $response = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);
        return new Response($response, $info);
    }


}