<?php

namespace FrontendBundle\Form\DataTransformer;

use Codeception\TestCase\Test;
use DDD\CoreDomain\DTO\UpdatePageWithStatusCommand;
use DDD\CoreDomain\Page\Status;
use DDD\CoreDomain\Page\Statuses;
use DDD\FrontendBundle\Form\DataTransformer\StatusTransformer;

/**
 * Class StatusTransformerTest
 *
 * @package FrontendBundle\Form\DataTransformer
 */
class StatusTranstformerTest extends Test
{
    public function testReverseTransformNull()
    {
        $transformer = new StatusTransformer();
        $this->assertNull($transformer->reverseTransform(null));
    }

    public function testReverseTransformEmptyCommand()
    {
        $command     = new UpdatePageWithStatusCommand();
        $transformer = new StatusTransformer();
        $this->assertEquals(
            new Status(null),
            $transformer->reverseTransform($command)
        );
    }

    public function testReverseTransformCommand()
    {
        $command       = new UpdatePageWithStatusCommand();
        $command->name = Statuses::PUBLISH;
        $transformer   = new StatusTransformer();
        $this->assertEquals(
            new Status(Statuses::PUBLISH),
            $transformer->reverseTransform($command)
        );
    }
}