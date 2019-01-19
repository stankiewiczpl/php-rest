<?php


namespace Stankiewiczpl\PhpRest\Requests;


interface RequestInterface
{
    public function setUrl(string $url): void;

    public function get_option(string $key);

    public function set_option(string $key, $value): void;

    public function setData(array $data = []);

    public function verbose($verbose = false);
}