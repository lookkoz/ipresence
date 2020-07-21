<?php
declare(strict_types=1);

namespace Ipresence\Root\Adapter;

interface IStorage {
    public function getAll(string $key) : array;
}