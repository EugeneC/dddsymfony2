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
    public function testReverseTransformNull()
    {
        $transformer = new MetaTagsTransformer();
        $this->assertNull($transformer->reverseTransform(null));
    }

    public function testReverseTransformEmptyCommand()
    {
        $command     = new UpdatePageWithMetaTagsCommand();
        $transformer = new MetaTagsTransformer();
        $this->assertEquals(
            new Tags(null, null),
            $transformer->reverseTransform($command)
        );
    }

    public function testReverseTransformCommand()
    {
        $command              = new UpdatePageWithMetaTagsCommand();
        $command->description = DESCRIPTION;
        $command->keywords    = KEYWORDS;
        $transformer          = new MetaTagsTransformer();
        $this->assertEquals(
            new Tags(DESCRIPTION, KEYWORDS),
            $transformer->reverseTransform($command)
        );
    }
}