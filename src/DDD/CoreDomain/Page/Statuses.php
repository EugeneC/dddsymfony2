<?php

namespace DDD\CoreDomain\Page;

/**
 * Class Statuses
 *
 * @package DDD\CoreDomain\Page
 */
class Statuses
{
    const PUBLISH = "publish";
    const DRAFT = "draft";

    /**
     * Get values as array
     * @return array
     */
    public static function getAsArray()
    {
        return  [
            Statuses::PUBLISH => Statuses::PUBLISH,
            Statuses::DRAFT   => Statuses::DRAFT
        ];
    }
}