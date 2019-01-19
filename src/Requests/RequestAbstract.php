<?php

namespace Stankiewiczpl\PhpRest\Requests;

abstract class RequestAbstract
{
    protected $method = 'GET';
    protected $options;
    protected $verbose;


    public function __construct(array $options = [])
    {
        $this->options = [
            'headers' => [],
            'parameters' => [],
            'curl_options' => [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER => false,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_USERAGENT => "PHP REST CLIENT",
                CURLOPT_CONNECTTIMEOUT => 60,
                CURLOPT_TIMEOUT => 60,
                CURLOPT_POST => false,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_CUSTOMREQUEST => $this->method,
                CURLOPT_VERBOSE => false
            ],
        ];

        $this->options = array_merge($this->options, $options);
    }

    public function setUrl(string $url): void
    {
        $this->options['curl_options'] += [CURLOPT_URL => $url];
    }


    public function set_option(string $key, $value): void
    {
        if ($key === 'curl_options') {
            $this->options['curl_options'] += $value;
        } else {
            $this->options[$key] = $value;
        }
    }

    public function get_option(string $key)
    {
        return $this->options[$key];
    }

    public function setData(array $data = [])
    {
        $this->set_option('curl_options', [CURLOPT_POSTFIELDS => json_encode($data)]);
    }

    public function verbose($verbose = false)
    {
        $this->options['curl_options'][CURLOPT_VERBOSE] = $verbose;
    }
}