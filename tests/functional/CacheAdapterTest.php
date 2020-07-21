<?php
namespace Ipresence\App;

use Ipresence\Root\Adapter\CacheAdapter;
use Predis\Client;
use PHPUnit\Framework\TestCase;

class CacheAdapterTest extends TestCase
{
    private $cache;

    public function SetUp() : void
    {
        $redisConfig = [
            'scheme' => 'tcp',
            'host' => '127.0.0.1',
            'port' => '6379',
            'password' => 'Li6sgcoWEzGlQrVbpaAS',
            'database' => 0
        ];
        $client = new Client($redisConfig);
        $this->cache = new CacheAdapter($client);

    }

    public function testGet()
    {
        $key = 'first';
        $value = ['hello'];

        $this->cache->set($key, $value);
        $this->assertSame($value, $this->cache->get('first')); 
    }

    public function testNotExistisngGet()
    {
        $this->assertSame([], $this->cache->get('not-existing'));
    }
}