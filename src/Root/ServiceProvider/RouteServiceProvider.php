<?php
declare(strict_types=1);

namespace Ipresence\Root\ServiceProvider;

use Ipresence\Root\Handler\GetShoutHandler;
use Slim\App;

class RouteServiceProvider
{
    /**
     * @param App $app
     * @return mixed
     */
    public function registerRoutes(App $app) {
        $app->get('/shout/{author}', $app->getContainer()->get(GetShoutHandler::class));
    }
}