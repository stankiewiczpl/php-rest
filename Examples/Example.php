<?php
require_once __DIR__ . '/../vendor/autoload.php';


use Stankiewiczpl\PhpRest\Client;
use Stankiewiczpl\PhpRest\Request;

class Example
{
    public function testGet()
    {

        $request = (new Request())->getInstance('get');
        $request->setUrl('https://jsonplaceholder.typicode.com/posts');

        $response = (new Client())->execute($request);
        //print_r($response->getInfo());
        print_r($response->getResult());
    }

    public function testPost()
    {

        $request = (new Request())->getInstance('post');
        $request->setUrl('https://jsonplaceholder.typicode.com/posts');
        $request->verbose(false);
        $request->setData([
                'userId' => 999,
                'title' => 'post title',
                'body' => 'Post body'
        ]);

        $response = (new Client())->execute($request);

        print_r($response->getResult());
    }

    public function testPut()
    {

        $request = (new Request())->getInstance('put');
        $request->setUrl('https://jsonplaceholder.typicode.com/posts/1');
        $request->verbose(false);
        $request->setData([
                'userId' => 999
        ]);

        $response = (new Client())->execute($request);

        print_r($response->getResult());
    }
    public function testPatch()
    {

        $request = (new Request())->getInstance('patch');
        $request->setUrl('https://jsonplaceholder.typicode.com/posts/1');
        $request->verbose(false);
        $request->setData([
                'title' => 'Title was changed.'
        ]);

        $response = (new Client())->execute($request);

        print_r($response->getResult());
    }
    public function testDelete()
    {

        $request = (new Request())->getInstance('delete');
        $request->setUrl('https://jsonplaceholder.typicode.com/posts/1');
        $request->verbose(false);

        $response = (new Client())->execute($request);

        print_r($response->getResult());
    }
}

$test = new Example();
$test->testGet();
$test->testPost();
$test->testPut();
$test->testDelete();
