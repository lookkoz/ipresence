<?php
declare(strict_types=1);

namespace Ipresence\Root\Handler;

use Psr\Http\Message\ServerRequestInterface;

interface HttpHandlerInterface
{
    public function getParams(ServerRequestInterface $request): array;
}