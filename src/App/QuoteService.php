<?php
declare(strict_types=1);

namespace Ipresence\App;

use Ipresence\Domain\QuoteList;

class QuoteService 
{
    private $repository;

    public function __construct(QuoteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function get(string $name, ?int $limit = null) : QuoteList
    {
        $data = $this->repository->get($name);
        
        if (count($data) > $limit && $limit > 0) {
            $data = array_slice($data, 0, $limit);
        }
        
        return new QuoteList($data);
    }
}