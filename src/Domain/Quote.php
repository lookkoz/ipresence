<?php
declare(strict_types=1);

namespace Ipresence\Domain;

use Ipresence\Domain\Exception\InvalidValueException;
use JsonSerializable;

class Quote implements JsonSerializable, QuoteInterface
{
    private $quote;
    
    public function __construct(string $q = null) {
        if ($q) {
            $this->setValue($q);
        }
    }

    public function setValue(string $q) : void {
        if (strlen($q) == 0) {
            throw new InvalidValueException("Quote string must not be empty.");
        }
        $this->quote = $q;
    }

    public function getValue() : string {

        return $this->quote;
    }

    public function jsonSerialize() : string {
        return $this->quote;
    }

    public function __toString()
    {
        return $this->quote;
    }
}