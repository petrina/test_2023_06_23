<?php

namespace App\Iterators;

use IteratorAggregate;

class NewsCollection implements IteratorAggregate
{
    private $news;

    public function __construct($news)
    {
        $this->news = $news;
    }

    public function getIterator(): NewsIterator
    {
        return new NewsIterator($this->news);
    }
}
