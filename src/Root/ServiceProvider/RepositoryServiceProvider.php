<?php
declare(strict_types=1);

namespace Ipresence\Root\ServiceProvider;

use DI\Container;
use Ipresence\App\QuoteRepository;
use Ipresence\Root\Adapter\CacheAdapter;
use Ipresence\Root\Adapter\FileReader;

class RepositoryServiceProvider implements ServiceProviderInterface
{
    public function register(Container $container) 
    {
        $container->set(QuoteRepository::class, function () use ($container) {
            return new QuoteRepository(
                $container->get(FileReader::class),
                $container->get(CacheAdapter::class),
            );
        });
    }
}