<?php
declare(strict_types=1);

namespace Ipresence\Domain\Filter;

use Ipresence\Domain\QuoteInterface;
use JsonSerializable;

abstract class Filter implements JsonSerializable, QuoteInterface {

    protected $quote;

    public function __construct(QuoteInterface $quote)
    {
        $this->quote = $quote;
    }

    abstract public function getValue(): string;

    public function __toString()
    {
        return $this->getValue();
    }

    public function jsonSerialize() : string {
        return $this->getValue();
    }
}