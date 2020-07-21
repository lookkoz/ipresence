<?php
declare(strict_types=1);

namespace Ipresence\Root\Adapter;

class FileReader implements IStorage 
{
    private $path;

    public function __construct(string $filePath)
    {
        $this->path = $filePath;
        if (!$this->isValid()) {
            throw new \RuntimeException("File does not exists {$this->path}", 500);
        }
    }

    /**
     * Returns all quotes in  associative array for a given author
     * @param string $author
     * @return array
     */
    public function getAll(string $author) : array 
    {
        $rawData = $this->readData();
        $data = json_decode($rawData, true);
        
        $quotes = [];
        foreach ($data['quotes'] as $i => $v) {
            if ($v['author'] == $author) {
                $quotes[] = $v['quote'];
            }
        }
        sort($quotes);

        return $quotes;
    }

    private function readData() : string
    {
        $data = file_get_contents($this->path);
        if ($data === false) {
            throw new \UnexpectedValueException("No data.");
        }
        return $data;
    }

    private function isValid() : bool {
        return file_exists($this->path);
    }
}