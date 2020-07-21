<?php
declare(strict_types=1);

namespace Ipresence\Root\Handler;

use Fig\Http\Message\StatusCodeInterface;
use Ipresence\App\QuoteService;
use Ipresence\Root\Exception\ValidationException;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class GetShoutHandler implements HttpHandlerInterface
{
    private $quoteService;

    public function __construct(QuoteService $service = null)
    {
        $this->quoteService = $service;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args) : ResponseInterface
    {
        try {
            $params = $this->getParams($request);
        } catch (ValidationException $e) {
            return $this->response($response, $e->getCode(), ['message' => $e->getMessage()]);
        }
        $quoteList = $this->quoteService->get($params['author'], $params['limit']);

        
        if (count($quoteList) === 0) {
            return $this->response($response, StatusCodeInterface::STATUS_NOT_FOUND, $quoteList);
        }
        
        return $this->response($response, StatusCodeInterface::STATUS_OK, $quoteList);
    }

    private function response(ResponseInterface $response, int $status, $jsonBody) : ResponseInterface
    {
        $response->getBody()->write($this->toJSON($jsonBody));
        return $response->withHeader('Content-Type', 'application/json; charset=utf-8')
                        ->withStatus($status);
    }

    private function toJSON($quoteList) : string
    {
        return json_encode($quoteList, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
    
    public function getParams(ServerRequestInterface $request): array
    {
        $params = [];
        $params['author'] = $this->filterParam($request->getAttribute('author'));

        $params['limit'] = null;
        if (isset($request->getQueryParams()['limit'])) {
            $params['limit'] = (int) $request->getQueryParams()['limit'];
        }

        if ($params['limit'] > 10 || $params['limit'] < 0) {
            throw new ValidationException("`limit` query parameter must be 0 < limit <= 10", 400);
        }

        return $params;
    }
    
    private function filterParam($name) {
        return ucwords(str_replace('-', ' ', $name));
    }
}