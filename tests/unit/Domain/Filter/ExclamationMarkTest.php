<?php

namespace Tests\Domain\Filter;

use Ipresence\Domain\Filter\ExclamationMark;
use Ipresence\Domain\Quote;
use PHPUnit\Framework\TestCase;

class ExclamationMarkTest extends TestCase {

    /**
     * @dataProvider parametersDataProvider
     */
    public function testGetValue($given, $expected)
    {
        $quote = new ExclamationMark(new Quote($given));
        $this->assertSame($expected, $quote->getValue());
    }

    public function parametersDataProvider()
    {
        return [
            ['test', 'test!'],
            ['test.', 'test!'],
            ['test!', 'test!'],
        ];
    }
}