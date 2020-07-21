<?php
declare(strict_types=1);

namespace Ipresence\Domain\Filter;

class Capitalizer extends Filter {

    public function getValue(): string
    {
        return strtoupper($this->quote->getValue());
    }
}