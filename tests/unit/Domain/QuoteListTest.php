<?php

namespace Tests\Domain;

use Exception;
use Ipresence\Domain\Filter\Capitalizer;
use Ipresence\Domain\Filter\ExclamationMark;
use Ipresence\Domain\Quote;
use PHPUnit\Framework\TestCase;
use Ipresence\Domain\QuoteList;

class QuoteListTest extends TestCase
{

    public function testJsonEncode()
    {
        $values = ["one", "two", "three"];

        $qList = new QuoteList();
        $qList->appendQuote(new Quote($values[0]));
        $qList->appendQuote(new Quote($values[1]));
        $qList->appendQuote(new Quote($values[2]));
        $this->assertEquals(json_encode($qList) , sprintf('["%s","%s","%s"]', $values[0], $values[1], $values[2]));
    }

    public function testQuoteListIterator()
    {
        $values = ["one", "two", "three"];

        $qList = new QuoteList();
        $qList->appendQuote(new Quote($values[0]));
        $qList->appendQuote(new Quote($values[1]));
        $qList->appendQuote(new Quote($values[2]));

        $this->assertEquals(0, $qList->key());
        $this->assertEquals($values[0], $qList->current());

        // test Iterator implementation
        foreach ($qList as $i => $quote) {
            $this->assertEquals($values[$i], sprintf("%s", $quote));
        }
    }

    public function testQuoteListIteratorWithFilters()
    {
        $values = ["one", "two"];
        $expected = ["ONE!", "TWO!"];

        $qList = new QuoteList();
        $qList->appendQuote(new Capitalizer(new ExclamationMark(new Quote($values[0]))));
        $qList->appendQuote(new Capitalizer(new ExclamationMark(new Quote($values[1]))));

        // test Iterator implementation
        foreach ($qList as $i => $quote) {
            $this->assertEquals($expected[$i], sprintf("%s", $quote));
        }

        $this->assertEquals(json_encode($expected), json_encode($qList));
    }
}