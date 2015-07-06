<?php

namespace CoreDomain\Page;

use Codeception\TestCase\Test;
use DDD\CoreDomain\Page\Tags;

/**
 * Class TagsTest
 *
 * @package CoreDomain\Page
 */
class TagsTest extends Test
{
    public function testGetters()
    {
        $tags = new Tags(DESCRIPTION, KEYWORDS);
        $this->assertEquals(DESCRIPTION, $tags->getDescription());
        $this->assertEquals(KEYWORDS, $tags->getKeywords());
    }
}