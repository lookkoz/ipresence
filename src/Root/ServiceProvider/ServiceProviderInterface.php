<?php
declare(strict_types=1);

namespace Ipresence\Root\ServiceProvider;

use DI\Container;

interface ServiceProviderInterface {
    public function register(Container $container);
}