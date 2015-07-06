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

    protected $status;
    protected $tags;

    public function _before()
    {
        $this->status = $this->getMockBuilder('DDD\CoreDomain\Page\Status')
            ->disableOriginalConstructor()
            ->getMock();
        $this->tags   = $this->getMockBuilder('DDD\CoreDomain\Page\Tags')
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testGetters()
    {
        $page = Page::publish(TITLE, BODY, SLUG, $this->tags, $this->status);
        $this->assertEquals(TITLE, $page->getTitle());
        $this->assertEquals(BODY, $page->getBody());
        $this->assertEquals(SLUG, $page->getSlug());
        $this->assertEquals($this->tags, $page->getTags());
        $this->assertEquals($this->status, $page->getStatus());
    }

    public function testFactoryMethods()
    {
        $content = [TITLE_UPDATED, BODY_UPDATED, SLUG_UPDATED, $this->tags, $this->status];
        $oldPage = Page::publish(TITLE, BODY, SLUG, $this->tags, $this->status);
        $this->assertEquals(
            call_user_func_array('DDD\CoreDomain\Page\Page::publish', $content),
            call_user_func_array([$oldPage, 'updateContent'], $content)
        );
    }
}