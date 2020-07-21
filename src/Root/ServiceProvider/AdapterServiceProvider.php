<?php
declare(strict_types=1);

namespace Ipresence\Root\ServiceProvider;

use DI\Container;
use Ipresence\Root\Adapter\CacheAdapter;
use Ipresence\Root\Adapter\FileReader;
use Predis\Client;

class AdapterServiceProvider implements ServiceProviderInterface
{
    public function register(Container $container) 
    {
        $container->set(FileReader::class, function () use ($container) {
            return new FileReader(realpath(__DIR__ . '/../../../data/quotes.json'));
        });

        $container->set(CacheAdapter::class, function () use ($container) {
            $redisConfig = [
                'scheme' => 'tcp',
                'host' => 'ipresence_redis',
                'port' => '6379',
                'password' => 'Li6sgcoWEzGlQrVbpaAS',
                'database' => 1
            ];
            $client = new Client($redisConfig);
            return new CacheAdapter($client);
        });
    }
}