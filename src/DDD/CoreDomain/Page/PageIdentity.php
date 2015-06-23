<?php

namespace DDD\CoreDomain\Page;

class PageIdentity
{
    private $value;

    public function __construct($value)
    {
        $this->value = (string)$value;
    }

    public function getValue()
    {
        return $this->value;
    }
}