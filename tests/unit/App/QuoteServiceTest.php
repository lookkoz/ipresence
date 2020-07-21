<?php
declare(strict_types=1);

namespace Ipresence\App;

use Ipresence\Domain\QuoteList;
use Ipresence\Root\Adapter\CacheAdapter;
use Ipresence\Root\Adapter\FileReader;
use PHPUnit\Framework\TestCase;

class QuoteServiceTest extends TestCase
{
    /** QuoteService */
    private $service;
    private $repository;
    private $cache;
    private $db;

    public function setUp() : void
    {
        $this->db = $this->createMock(FileReader::class);
        $this->db->method('getAll')
            ->willReturn(['first quote', 'second quote', 'third quote']);

        $this->cache = $this->createMock(CacheAdapter::class);
        $this->cache->method('get')
            ->willReturn(['first quote from cache', 'second quote from cache', 'third quote from cache']);

        $this->repository = new QuoteRepository($this->db, $this->cache);
    }
    
    
    public function testGet()
    {
        $service = new QuoteService($this->repository);
        $quotes = $service->get('anything');

        $this->assertEquals('FIRST QUOTE FROM CACHE!', $quotes->current()->getValue());
        $this->assertInstanceOf(QuoteList::class, $quotes);
    }

    public function testGetWithLimit()
    {
        $this->service = new QuoteService($this->repository);
        $quotes = $this->service->get('anything', 1);

        $this->assertEquals(1, count($quotes));
    }

    public function testCache()
    {
        $cache = $this->createMock(CacheAdapter::class);
        $cache->method('get')->willReturn([]);

        $repository = new QuoteRepository($this->db, $cache);
        $this->service = new QuoteService($repository);
        $quotes = $this->service->get('anything', 2);

        $this->assertEquals(2, count($quotes));
        $this->assertEquals($quotes->current()->getValue(), 'FIRST QUOTE!');

    }
}