<?php
declare(strict_types=1);

namespace Ipresence\App;

use Ipresence\Root\Adapter\ICache;
use Ipresence\Root\Adapter\IStorage;

class QuoteRepository {

    private $db;
    private $cache;

    public function __construct(IStorage $db, ICache $cache)
    {
        $this->db = $db;
        $this->cache = $cache;
    }

    public function get(string $name): array
    {
        if ($data = $this->cache->get($name)) {
            return $data;
        }

        $data = $this->db->getAll($name);
        if (!empty($data)) {
            $this->cache->set($name, $data);
        }

        return $data;
    }



}