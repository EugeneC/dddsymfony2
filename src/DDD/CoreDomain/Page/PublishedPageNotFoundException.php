<?php

namespace DDD\CoreDomain\Page;

use DDD\CoreDomain\SharedException\ExceptionInterface;

/**
 * Class PublishedPageNotFoundException
 *
 * @package DDD\CoreDomain\Page
 */
class PublishedPageNotFoundException extends \Exception implements ExceptionInterface
{
}