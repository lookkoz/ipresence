<?php
declare(strict_types=1);

namespace Ipresence\Root\Adapter;

use Predis\Client;

class CacheAdapter implements ICache
{
    private $client;
    
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function get(string $key) : array
    {
        $value = $this->client->get($key);
        if (!$value) {
            return [];
        }
        //error_log("REDIS: Value $value comes from Cache", 0);
        return unserialize($value);
    }

    public function set(string $key, array $data) 
    {
        $value = serialize($data);
        $this->client->set($key, $value);
        //error_log("REDIS: Value $value saved in Cache", 0);
    }
}