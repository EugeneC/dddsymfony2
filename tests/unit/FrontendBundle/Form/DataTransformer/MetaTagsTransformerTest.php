<?php

namespace FrontendBundle\Form\DataTransformer;

use Codeception\TestCase\Test;
use DDD\CoreDomain\DTO\UpdatePageWithMetaTagsCommand;
use DDD\CoreDomain\Page\Tags;
use DDD\FrontendBundle\Form\DataTransformer\MetaTagsTransformer;

/**
 * Class MetaTagsTransformerTest
 *
 * @package FrontendBundle\Form\DataTransformer
 */
class MetaTagsTransformerTest extends Test
{

    protected $command;
    protected $tags;

    public function _before()
    {
        $this->command = $this->getMockBuilder('DDD\CoreDomain\DTO\UpdatePageWithMetaTagsCommand')
            ->disableOriginalConstructor()
            ->getMock();
        $this->tags    = $this->getMockBuilder('DDD\CoreDomain\Page\Tags')
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testReverseTransformNull()
    {
        $transformer = new MetaTagsTransformer();
        $this->assertNull($transformer->reverseTransform(null));
    }

    public function testReverseTransformEmptyCommand()
    {
        $transformer       = new MetaTagsTransformer();
        $transfromeredTags = $transformer->reverseTransform($this->command);
        $this->assertEquals($this->tags->getDescription(), $transfromeredTags->getDescription());
        $this->assertEquals($this->tags->getKeywords(), $transfromeredTags->getKeywords());
        $this->assertInstanceOf('DDD\CoreDomain\Page\Tags', $transfromeredTags);
    }

    public function testReverseTransformCommand()
    {
        $this->command->description = DESCRIPTION;
        $this->command->keywords    = KEYWORDS;
        $this->tags
            ->method('getDescription')
            ->will($this->returnValue(DESCRIPTION));
        $this->tags
            ->method('getKeywords')
            ->will($this->returnValue(KEYWORDS));
        $transformer       = new MetaTagsTransformer();
        $transfromeredTags = $transformer->reverseTransform($this->command);
        $this->assertEquals($this->tags->getDescription(), $transfromeredTags->getDescription());
        $this->assertEquals($this->tags->getKeywords(), $transfromeredTags->getKeywords());
        $this->assertInstanceOf('DDD\CoreDomain\Page\Tags', $transfromeredTags);
    }
}