<?php

namespace Tests\Domain\Filter;

use Ipresence\Domain\Filter\Capitalizer;
use Ipresence\Domain\Quote;
use PHPUnit\Framework\TestCase;

class CapitalizerTest extends TestCase {

    public function testGetValue()
    {
        $quote = new Capitalizer(new Quote('test'));
        $this->assertSame('TEST', $quote->getValue());
    }
}