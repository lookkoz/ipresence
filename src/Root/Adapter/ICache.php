<?php
declare(strict_types=1);

namespace Ipresence\Root\Adapter;

interface ICache {
    public function get(string $name) : array;
    public function set(string $name, array $data);
}