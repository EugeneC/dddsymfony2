<?php

namespace CoreDomain\Page;

use Codeception\TestCase\Test;
use DDD\CoreDomain\Page\Status;
use DDD\CoreDomain\Page\Statuses;

/**
 * Class StatusTest
 *
 * @package CoreDomain\Page
 */
class StatusTest extends Test
{
    /** @test */
    public function ItShouldCastToString()
    {
        $status = new Status(Statuses::PUBLISH);
        $this->assertEquals(
            Statuses::PUBLISH,
            (string) $status,
            'Casting a Status to a string should return the string version of the status'
        );
    }

    public function testGetters()
    {
        $status = new Status(Statuses::PUBLISH);
        $this->assertEquals(Statuses::PUBLISH, $status->getName());
    }
}