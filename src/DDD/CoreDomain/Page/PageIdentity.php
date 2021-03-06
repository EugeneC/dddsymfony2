<?php

namespace DDD\CoreDomain\Page;

/**
 * Class PageIdentity
 *
 * @package DDD\CoreDomain\Page
 */
class PageIdentity
{
    private $value;

    /**
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value = (string) $value;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}