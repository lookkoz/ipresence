<?php
declare(strict_types=1);

namespace Ipresence\Domain;

use Countable;
use Ipresence\Domain\Filter\Capitalizer;
use Ipresence\Domain\Filter\ExclamationMark;
use Iterator;
use JsonSerializable;

class QuoteList implements Iterator, JsonSerializable, Countable
{
    private $position;
    private $quoteList; 

    public function __construct(array $list = null, int $limit = null) {
        $this->quoteList = [];
        $this->position = 0;

        if ($list !== null) {
            $this->setList($list, $limit);
        }
    }

    public function appendQuote(QuoteInterface $q) {
        array_push($this->quoteList, $q);
    }

    public function setList(array $list, int $limit = null) {
        foreach ($list as $key => $value) {
            $this->appendQuote(new ExclamationMark(new Capitalizer(new Quote($value))));
        }
    }

    public function rewind() {
        $this->position = 0;
    }

    public function current() {
        return $this->quoteList[$this->position];
    }

    public function key() {
        return $this->position;
    }

    public function next() {
        ++$this->position;
    }

    public function valid() {
        return isset($this->quoteList[$this->position]);
    }

    public function jsonSerialize() : array {
        return $this->quoteList;
    }

    public function count()
    {
        return count($this->quoteList);
    }
}