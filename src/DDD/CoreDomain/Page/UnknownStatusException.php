<?php

namespace DDD\CoreDomain\Page;

use DDD\CoreDomain\SharedException\ExceptionInterface;

/**
 * Class UnknownStatusException
 *
 * @package DDD\CoreDomain\Page
 */
class UnknownStatusException extends \Exception implements ExceptionInterface
{
}