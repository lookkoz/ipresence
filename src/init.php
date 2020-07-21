<?php
declare(strict_types=1);

use DI\Container;
use Ipresence\Root\ServiceProvider\AdapterServiceProvider;
use Ipresence\Root\ServiceProvider\AppServiceProvider;
use Ipresence\Root\ServiceProvider\HandlerServiceProvider;
use Ipresence\Root\ServiceProvider\RepositoryServiceProvider;
use Ipresence\Root\ServiceProvider\RouteServiceProvider;
// use Pimple\Psr11\Container;
// use Pimple\Container as DefaultContainer;
use Slim\Factory\AppFactory;

// require __DIR__ . '/../vendor/autoload.php';

/**
 * Instantiate App
 *
 * In order for the factory to work you need to ensure you have installed
 * a supported PSR-7 implementation of your choice e.g.: Slim PSR-7 and a supported
 * ServerRequest creator (included with Slim PSR-7)
 */
//$container = new Container(new DefaultContainer());
$container = new Container();
AppFactory::setContainer($container);
$app = AppFactory::create();
$container = $app->getContainer();

// Add Routing Middleware
$app->addRoutingMiddleware();

/**
 * Add Error Handling Middleware
 *
 * @param bool $displayErrorDetails -> Should be set to false in production
 * @param bool $logErrors -> Parameter is passed to the default ErrorHandler
 * @param bool $logErrorDetails -> Display error details in error log
 * which can be replaced by a callable of your choice.
 
 * Note: This middleware should be added last. It will not handle any exceptions/errors
 * for middleware added after it.
 */
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

(new AdapterServiceProvider())->register($container);
(new RepositoryServiceProvider())->register($container);
(new AppServiceProvider())->register($container);
(new HandlerServiceProvider())->register($container);
(new RouteServiceProvider())->registerRoutes($app);

// Define app routes

// Run app
$app->run();