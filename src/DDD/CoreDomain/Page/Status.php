<?php

namespace DDD\CoreDomain\Page;

/**
 * Class Status
 *
 * @package DDD\CoreDomain\Page
 */
class Status
{
    protected $name;

    /** @var array */
    //private static $statuses;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        /*if (!isset(static::$statuses)) {
            static::$statuses = [null, Statuses::PUBLISH, Statuses::DRAFT];
        }
        if (!in_array($name, static::$statuses)) {
            throw new UnknownStatusException($name);
        }*/
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}