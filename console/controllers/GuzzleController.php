<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/29
 * Time: 15:45
 */

namespace console\controllers;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7;
use GuzzleHttp\Client;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;
use yii\base\ErrorException;
use yii\console\Controller;
use GuzzleHttp\Promise;
use GuzzleHttp\Exception\RequestException;

class GuzzleController extends Controller
{

    /**
     * 三种：
     * 1. new Client->request(method, uri)
     * 2. new Client->get(url)
     * 3. new Request(method, url)->$client->send($request)
     */
    public function actionRequest()
    {
        $client = new Client([
            'base_uri' => 'http://httpbin.org/',
            'timeout' => 2.0,
        ]);

        $response = $client->request('GET', 'get');
        // Query String Parameters
        $response = $client->request('GET', 'http://httpbin.org?foo=bar');
        $response = $client->request('GET', 'http://httpbin.org', [
            'query' => ['foo' => 'bar']
        ]);
        $response = $client->request('GET', 'http://httpbin.org', ['query' => 'foo=bar']);

        $response = $client->get('http://httpbin.org/get');
        $response = $client->delete('http://httpbin.org/delete');
        $response = $client->head('http://httpbin.org/get');
        $response = $client->options('http://httpbin.org/get');
        $response = $client->patch('http://httpbin.org/patch');
        $response = $client->post('http://httpbin.org/post');

        $response = $client->put('http://httpbin.org/put');

        $request = new Request('PUT', 'http://httpbin.org/put');
        $response = $client->send($request, ['timeout' => 2]);
    }

    public function actionFormRequest()
    {
        $client = new Client();
//        $response = $client->request('POST', 'http://httpbin.org/post', [
//            'form_params' => [
//                'field_name' => 'abc',
//                'other_field' => '123',
//                'nested_field' => [
//                    'nested' => 'hello'
//                ]
//            ]
//        ]);

        $response = $client->request('POST', 'http://httpbin.org/post', [
            'multipart' => [
                [
                    'name' => 'field_name',
                    'contents' => 'abc'
                ],
                [
                    'name' => 'file_name',
                    'contents' => fopen('/path/to/file', 'r')
                ],
                [
                    'name' => 'other_file',
                    'contents' => 'hello',
                    'filename' => 'filename.txt',
                    'headers' => [
                        'X-Foo' => 'this is an extra header to include'
                    ]
                ]
            ]
        ]);

        echo $response->getReasonPhrase();
    }

    public function actionAsyncRequest()
    {
        $client = new Client([
            'base_uri' => 'http://httpbin.org/',
            'timeout' => 2.0,
        ]);
        // Async Requests
        $promise = $client->getAsync('http://httpbin.org/get');
        $promise = $client->deleteAsync('http://httpbin.org/delete');
        $promise = $client->headAsync('http://httpbin.org/get');
        $promise = $client->optionsAsync('http://httpbin.org/get');
        $promise = $client->patchAsync('http://httpbin.org/patch');
        $promise = $client->postAsync('http://httpbin.org/post');
        $promise = $client->putAsync('http://httpbin.org/put');

        $headers = ['X-Foo' => 'Bar'];
        $body = 'Hello!';
        $request = new Request('HEAD', 'http://httpbin.org/head', $headers, $body);
        $promise = $client->sendAsync($request);

        $promise = $client->requestAsync('GET', 'http://httpbin.org/get');
    }

    public function actionConcurrentRequest()
    {
        $client = new Client([
            'base_uri' => 'http://httpbin.org/',
            'timeout' => 2.0,
        ]);

// Initiate each request but do not block
        $promises = [
            'image' => $client->getAsync('/image'),
            'png' => $client->getAsync('/image/png'),
            'jpeg' => $client->getAsync('/image/jpeg'),
            'webp' => $client->getAsync('/image/webp')
        ];

// Wait on all of the requests to complete. Throws a ConnectException
// if any of the requests fail
        $results = Promise\unwrap($promises);

// Wait for the requests to complete, even if some of them fail
        try {
            $results = Promise\settle($promises)->wait();

        } catch (ErrorException $exception) {
            var_dump($exception->getMessage());
        }

// You can access each result using the key provided to the unwrap
// function.
        echo $results['image']['value']->getHeader('Content-Length')[0] . "\n";
        echo $results['webp']['value']->getHeader('Content-Length')[0] . "\n";
        echo $results['jpeg']['value']->getHeader('Content-Length')[0] . "\n";
        echo $results['png']['value']->getHeader('Content-Length')[0];

        // two
        $requests = function ($total) {
            $uri = 'http://127.0.0.1:8126/guzzle-server/perf';
            for ($i = 0; $i < $total; $i++) {
                yield new Request('GET', $uri);
            }
        };

        $pool = new Pool($client, $requests(100), [
            'concurrency' => 5,
            'fulfilled' => function ($response, $index) {
                // this is delivered each successful response
            },
            'rejected' => function ($reason, $index) {
                // this is delivered each failed request
            },
        ]);

// Initiate the transfers and create a promise
        $promise = $pool->promise();

// Force the pool of requests to complete.
        $promise->wait();

        // third
        $requests = function ($total) use ($client) {
            $uri = 'http://127.0.0.1:8126/guzzle-server/perf';
            for ($i = 0; $i < $total; $i++) {
                yield function () use ($client, $uri) {
                    return $client->getAsync($uri);
                };
            }
        };

        $pool = new Pool($client, $requests(100));
    }

    public function actionResponse()
    {
        $client = new Client([
            'base_uri' => 'http://httpbin.org/',
            'timeout' => 2.0,
        ]);

        $response = $client->request('GET', 'get');
        $code = $response->getStatusCode(); // 200
        echo $code . "\r\n";
        $reason = $response->getReasonPhrase(); // OK
        echo $reason . "\r\n";
        echo "\r\n";
        if ($response->hasHeader('Content-Length')) {
            echo "Content-Length is exists" . "\r\n";
        }

// Get a header from the response.
        echo $response->getHeader('Content-Length')[0] . "\r\n";

// Get all of the response headers.
        foreach ($response->getHeaders() as $name => $values) {
            echo $name . ': ' . implode(', ', $values) . "\r\n";
        }
        echo "\r\n";
        $body = $response->getBody();
// Implicitly cast the body to a string and echo it
        echo $body . "\r\n";
// Explicitly cast the body to a string
        $stringBody = (string)$body;
        echo $stringBody . "\r\n";
// Read 10 bytes from the body
        $tenBytes = $body->read(10);
        echo $tenBytes . "\r\n";
// Read the remaining contents of the body as a string
        $remainingBytes = $body->getContents();
        echo $remainingBytes . "\r\n";
    }

    public function actionUploadData()
    {
        $client = new Client();
//        $r = $client->request('POST', 'http://httpbin.org/post', [
//            'body' => 'raw data'
//        ]);

// Provide an fopen resource.
//        $body = fopen('/path/to/file', 'r');
//        $r = $client->request('POST', 'http://httpbin.org/post', ['body' => $body]);

// Use the stream_for() function to create a PSR-7 stream.
//        $body = \GuzzleHttp\Psr7\stream_for('hello!');
//        $r = $client->request('POST', 'http://httpbin.org/post', ['body' => $body]);
//
        $r = $client->request('PUT', 'http://httpbin.org/put', [
            'json' => ['foo' => 'bar']
        ]);
        echo $r->getReasonPhrase();
    }

    public function actionCookie()
    {
//        $client = new Client();
//        $jar = new \GuzzleHttp\Cookie\CookieJar;
//        $r = $client->request('GET', 'http://httpbin.org/cookies', [
//            'cookies' => $jar
//        ]);

        // Use a shared client cookie jar
        $client = new \GuzzleHttp\Client(['cookies' => true]);
        $r = $client->request('GET', 'http://httpbin.org/cookies');
        echo $r->getReasonPhrase();
    }

    public function actionRedirect()
    {
        $client = new Client();
        $response = $client->request('GET', 'http://httpbin.org/redirect/3');
        echo $response->getStatusCode() . "\n";

        $response = $client->request('GET', 'http://github.com', [
            'allow_redirects' => false
        ]);
        echo $response->getStatusCode() . "\n";

        $response = $client->request('GET', 'http://httpbin.org/redirect/3', ['allow_redirects' => false]);
        echo $response->getStatusCode();
    }
    
    public function actionException()
    {
        $client = new Client();
        // Exceptions
        try {
            $client->request('GET', 'https://github.com/_abc_123_404');
        } catch (RequestException $e) {
            echo Psr7\str($e->getRequest());
//            if ($e->hasResponse()) {
//                echo Psr7\str($e->getResponse());
//                echo Psr7\str($e->getCode());
//            }
        }

//        try {
//            $client->request('GET', 'https://github.com/_abc_123_404');
//        } catch (ClientException $e) {
//            echo Psr7\str($e->getRequest());
//            echo Psr7\str($e->getResponse());
//        }
    }
}