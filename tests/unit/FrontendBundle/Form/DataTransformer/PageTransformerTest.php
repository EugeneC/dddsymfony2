<?php

namespace FrontendBundle\Form\DataTransformer;

use Codeception\TestCase\Test;
use DDD\CoreDomain\DTO\AddPageCommand;
use DDD\CoreDomain\Page\Page;
use DDD\CoreDomain\Page\Tags;
use DDD\CoreDomain\Page\Status;
use DDD\CoreDomain\Page\Statuses;
use DDD\FrontendBundle\Form\DataTransformer\PageTransformer;
use Sonata\DoctrineMongoDBAdminBundle\Model\ModelManager;

/**
 * Class PageTransformerTest
 *
 * @package FrontendBundle\Form\DataTransformer
 */
class PageTranstformerTest extends Test
{
    protected $manager;

    /**
     * Setup manager object to test.
     */
    public function setUp()
    {
        $this->manager = $this->getMockBuilder('Sonata\DoctrineMongoDBAdminBundle\Model\ModelManager')
            ->disableOriginalConstructor()
            ->getMock();

    }

    public function testReverseTransformNull()
    {
        $this->manager->expects($this->once())
            ->method('findOneBy')
            ->will($this->returnValue(null));
        $pageCommand = new AddPageCommand();
        $transformer = new PageTransformer($this->manager);
        $this->assertNull($transformer->reverseTransform($pageCommand));
    }

    public function testReverseTransformCommandEqualsObjects()
    {
        $status                 = new Status(Statuses::PUBLISH);
        $tags                   = new Tags(DESCRIPTION, KEYWORDS);
        $pageCommand            = new AddPageCommand();
        $pageCommand->slug      = SLUG;
        $pageCommand->withBody  = BODY;
        $pageCommand->withTitle = TITLE;
        $pageCommand->status    = $status;
        $pageCommand->tags      = $tags;
        $page                   = Page::publish(TITLE, BODY, SLUG, $tags, $status);
        $this->manager->expects($this->once())
            ->method('findOneBy')
            ->will($this->returnValue($page));
        $transformer = new PageTransformer($this->manager);
        $this->assertEquals(clone $page, $transformer->reverseTransform($pageCommand));
    }
}