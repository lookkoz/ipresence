<?php

namespace Tests\Domain;

use Ipresence\Domain\Exception\InvalidValueException;
use Ipresence\Domain\Quote;
use PHPUnit\Framework\TestCase;

class QuoteTest extends TestCase
{

    public function testQuote()
    {
        $quote = new Quote();
        $quote->setValue("sample quote");
        $this->assertEquals("sample quote", $quote->getValue());
    }

    public function testQuoteVaidation() 
    {
        $q = new Quote();

        $this->expectException(InvalidValueException::class);
        $q->setValue("");
    }
}