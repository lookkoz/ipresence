<?php
declare(strict_types=1);

namespace Ipresence\Domain;

interface QuoteInterface {
    public function getValue() : string;
}