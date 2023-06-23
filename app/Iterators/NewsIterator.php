<?php

namespace App\Iterators;

use Iterator;

class NewsIterator implements Iterator
{
    private $news;
    private $position = 0;

    public function __construct($news)
    {
        $this->news = $news;
    }

    public function current(): mixed
    {
        return $this->news[$this->position];
    }

    public function key(): int
    {
        return $this->position;
    }

    public function next(): void
    {
        $this->position++;
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function valid(): bool
    {
        return isset($this->news[$this->position]);
    }
}
