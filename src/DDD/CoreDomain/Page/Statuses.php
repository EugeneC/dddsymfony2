<?php

namespace DDD\CoreDomain\Page;

class Statuses
{
    const PUBLISH = "publish";
    const DRAFT = "draft";

    public static function getAsArray()
    {
        return  [
            Statuses::PUBLISH => Statuses::PUBLISH,
            Statuses::DRAFT   => Statuses::DRAFT
        ];
    }
}