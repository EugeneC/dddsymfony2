<?php

namespace CoreDomain\Page;

use Codeception\TestCase\Test;
use DDD\CoreDomain\Page\Page;
use DDD\CoreDomain\Page\Status;
use DDD\CoreDomain\Page\Statuses;
use DDD\CoreDomain\Page\Tags;

/**
 * Class PageTest
 *
 * @package CoreDomain\Page
 */
class PageTest extends Test
{
    public function testGetters()
    {
        $page = Page::publish(
            TITLE,
            BODY,
            SLUG,
            $tags = new Tags(DESCRIPTION, KEYWORDS),
            $status = new Status(Statuses::PUBLISH)
        );
        $this->assertEquals(TITLE, $page->getTitle());
        $this->assertEquals(BODY, $page->getBody());
        $this->assertEquals(SLUG, $page->getSlug());
        $this->assertEquals($tags, $page->getTags());
        $this->assertEquals($status, $page->getStatus());
    }

    public function testFactoryMethods()
    {
        $content = [
            TITLE_UPDATED,
            BODY_UPDATED,
            SLUG_UPDATED,
            new Tags(DESCRIPTION_UPDATED, KEYWORDS_UPDATED),
            new Status(Statuses::DRAFT)
        ];
        $oldPage = Page::publish(
            TITLE,
            BODY,
            SLUG,
            new Tags(DESCRIPTION, KEYWORDS),
            new Status(Statuses::PUBLISH)
        );
        $this->assertEquals(
            call_user_func_array('DDD\CoreDomain\Page\Page::publish', $content),
            call_user_func_array([$oldPage, 'updateContent'], $content)
        );
    }
}