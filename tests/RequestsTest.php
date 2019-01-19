<?php

namespace Stankiewiczpl\PhpRest\Tests;

use PHPUnit\Framework\TestCase;
use Stankiewiczpl\PhpRest\Client;
use Stankiewiczpl\PhpRest\Exceptions\InvalidRequestException;
use Stankiewiczpl\PhpRest\Request;
use Stankiewiczpl\PhpRest\Requests\RequestInterface;
use Stankiewiczpl\PhpRest\Response;

class RequestsTest extends TestCase
{
    private $restClient;
    private $request;

    public function __construct(string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->restClient = new Client();
        $this->request = new Request();
    }

    public function test_it_invalid_method_exception()
    {

        $this->expectException(InvalidRequestException::class);

        $this->request->getInstance('bad request name');
    }

    public function test_it_specified_requests_exists()
    {
        $this->assertInstanceOf(RequestInterface::class, $this->request->getInstance('get'));
        $this->assertInstanceOf(RequestInterface::class, $this->request->getInstance('post'));
        $this->assertInstanceOf(RequestInterface::class, $this->request->getInstance('put'));
        $this->assertInstanceOf(RequestInterface::class, $this->request->getInstance('patch'));
        $this->assertInstanceOf(RequestInterface::class, $this->request->getInstance('delete'));
    }

    public function test_it_get_method_posts_response_is_ok()
    {
        $request = $this->request->getInstance('get');

        $request->setUrl('https://jsonplaceholder.typicode.com/posts');
        $response = $this->restClient->execute($request);
        $this->assertInstanceOf(Response::class, $response);
        $this->assertTrue($response->getInfo('http_code') === 200);

        $request->setUrl('https://jsonplaceholder.typicode.com/posts/1');
        $response = $this->restClient->execute($request);
        $this->assertInstanceOf(Response::class, $response);
        $this->assertTrue($response->getInfo('http_code') === 200);

        $request->setUrl('https://jsonplaceholder.typicode.com/posts/1/comments');
        $response = $this->restClient->execute($request);
        $this->assertInstanceOf(Response::class, $response);
        $this->assertTrue($response->getInfo('http_code') === 200);

        $request->setUrl('https://jsonplaceholder.typicode.com/posts?userId=1');
        $response = $this->restClient->execute($request);
        $this->assertInstanceOf(Response::class, $response);
        $this->assertTrue($response->getInfo('http_code') === 200);

    }

    public function test_it_post_method_posts_response_is_ok()
    {
        $postData = [
            'userId' => 999,
            'title' => 'post title',
            'body' => 'Post body'
        ];
        $request = $this->request->getInstance('post');

        $request->setUrl('https://jsonplaceholder.typicode.com/posts');
        $request->setData($postData);
        $response = $this->restClient->execute($request);
        $this->assertInstanceOf(Response::class, $response);
        $this->assertTrue($response->getInfo('http_code') === 201);


        $this->assertJsonStringEqualsJsonString(
            $response->getResult(),
            json_encode(array_merge($postData, ['id' => 101]))
        );

    }

    public function test_it_put_method_posts_response_is_ok()
    {
        $postData = [
            'userId' => 999
        ];
        $request = $this->request->getInstance('put');

        $request->setUrl('https://jsonplaceholder.typicode.com/posts/1');
        $request->setData($postData);
        $response = $this->restClient->execute($request);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertTrue($response->getInfo('http_code') === 200);
        $this->assertJsonStringEqualsJsonString(
            json_encode(['id'=>1,'userId' =>999]),
            $response->getResult()

        );

    }

    public function test_it_patch_method_posts_response_is_ok()
    {
        $postData = [
            'title' => 'Title changed',
            'body' => 'Body changed',
        ];
        $request = $this->request->getInstance('patch');

        $request->setUrl('https://jsonplaceholder.typicode.com/posts/1');
        $request->setData($postData);
        $response = $this->restClient->execute($request);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertTrue($response->getInfo('http_code') === 200);
        $this->assertJsonStringEqualsJsonString(
            json_encode([
                'id' => 1,
                'title'=>'Title changed',
                'userId' =>1,
                'body' => 'Body changed']),
            $response->getResult()

        );

    }
    public function test_it_delete_method_posts_response_is_ok()
    {

        $request = $this->request->getInstance('delete');

        $request->setUrl('https://jsonplaceholder.typicode.com/posts/1');
        $response = $this->restClient->execute($request);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertTrue($response->getInfo('http_code') === 200);
        $this->assertJsonStringEqualsJsonString(
            json_encode(new \stdClass()),
            $response->getResult()

        );

    }

}