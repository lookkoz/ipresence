<?php
namespace Ipresence\App;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use PHPUnit\Framework\TestCase;

class GetShoutTest extends TestCase
{
    public function testGet()
    {
        $client = new Client();
        $response = $client->request('GET', 'http://ipresence:8000/shout/steve-jobs');

        $body = '[
            "THE ONLY WAY TO DO GREAT WORK IS TO LOVE WHAT YOU DO!",
            "YOUR TIME IS LIMITED, SO DON’T WASTE IT LIVING SOMEONE ELSE’S LIFE!"
        ]';

        $expectedBody = json_encode(json_decode($body), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        $this->assertSame(200, $response->getStatusCode()); // 200
        $this->assertSame('application/json; charset=utf-8', $response->getHeaderLine('content-type')); 
        $this->assertSame($expectedBody, $response->getBody()->__toString()); 
    }

    public function testGetNotFound()
    {
        $client = new Client();

        try {
            $response = $client->request('GET', 'http://ipresence:8000/shout/steve-j');
        } catch (RequestException $exception) {
            $response = $exception->getResponse();
        }

        $body = '[]';
        $this->assertSame(404, $response->getStatusCode());
        $this->assertSame('application/json; charset=utf-8', $response->getHeaderLine('content-type')); 
        $this->assertSame($body, $response->getBody(true)->__toString()); 
    }

    public function testGetWithLimit()
    {
        $client = new Client();
        $response = $client->request('GET', 'http://ipresence:8000/shout/steve-jobs?limit=1');

        $body = '[
            "THE ONLY WAY TO DO GREAT WORK IS TO LOVE WHAT YOU DO!"
        ]';
        $expectedBody = json_encode(json_decode($body), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('application/json; charset=utf-8', $response->getHeaderLine('content-type')); 
        $this->assertSame($expectedBody, $response->getBody()->__toString()); 
    }
}