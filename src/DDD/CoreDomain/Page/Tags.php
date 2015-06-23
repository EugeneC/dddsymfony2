<?php

namespace DDD\CoreDomain\Page;

class Tags
{
    protected $description;
    protected $keywords;

    public function __construct($description, $keywords)
    {
        $this->description = $description;
        $this->keywords    = $keywords;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getKeywords()
    {
        return $this->keywords;
    }
}