<?php

namespace DDD\CoreDomain\User;

/**
 * Class UserIdentity
 *
 * @package DDD\CoreDomain\User
 */
class UserIdentity
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