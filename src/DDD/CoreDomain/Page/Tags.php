<?php

namespace DDD\CoreDomain\Page;

/**
 * Class Tags
 *
 * @package DDD\CoreDomain\Page
 */
class Tags
{
    protected $description;
    protected $keywords;

    /**
     * @param string $description
     * @param string $keywords
     */
    public function __construct($description, $keywords)
    {
        $this->description = $description;
        $this->keywords    = $keywords;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getKeywords()
    {
        return $this->keywords;
    }
}