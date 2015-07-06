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
    protected $command;
    protected $status;

    public function _before()
    {
        $this->command = $this->getMockBuilder('DDD\CoreDomain\DTO\UpdatePageWithStatusCommand')
            ->disableOriginalConstructor()
            ->getMock();
        $this->status  = $this->getMockBuilder('DDD\CoreDomain\Page\Status')
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testReverseTransformNull()
    {
        $transformer = new StatusTransformer();
        $this->assertNull($transformer->reverseTransform(null));
    }

    public function testReverseTransformEmptyCommand()
    {
        $transformer         = new StatusTransformer();
        $transfromeredStatus = $transformer->reverseTransform($this->command);
        $this->assertEquals($this->status->getName(), $transfromeredStatus->getName());
        $this->assertInstanceOf('DDD\CoreDomain\Page\Status', $transfromeredStatus);
    }

    public function testReverseTransformCommand()
    {
        $this->command->name = Statuses::PUBLISH;
        $transformer         = new StatusTransformer();
        $this->status
            ->method('getName')
            ->will($this->returnValue(Statuses::PUBLISH));
        $transfromeredStatus = $transformer->reverseTransform($this->command);
        $this->assertEquals($this->status->getName(), $transfromeredStatus->getName());
        $this->assertInstanceOf('DDD\CoreDomain\Page\Status', $transfromeredStatus);
    }
}