<?php
declare(strict_types=1);

namespace Ipresence\Root\ServiceProvider;

use DI\Container;
use Ipresence\App\QuoteService;
use Ipresence\Root\Handler\GetShoutHandler;

class HandlerServiceProvider implements ServiceProviderInterface
{
    public function register(Container $container) 
    {
        $container->set(GetShoutHandler::class, function () use ($container) {
            return new GetShoutHandler($container->get(QuoteService::class));
        });
    }
}