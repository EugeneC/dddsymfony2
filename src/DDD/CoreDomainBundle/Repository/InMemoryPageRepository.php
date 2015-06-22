<?php

namespace DDD\CoreDomainBundle\Repository;

use DDD\CoreDomain\Page\Page;
use DDD\CoreDomain\Page\PageIdentity;
use DDD\CoreDomain\Page\PageRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class InMemoryPageRepository implements PageRepository
{
    private $pages;

    public function __construct()
    {
        $this->pages[] = new Page(
            new PageIdentity('8CE05088-ED1F-43E9-A415-3B3792655A9B'), 'Home page', 'Welcome to Home Page', 'home', null, null, true
        );
        $this->pages[] = new Page(
            new PageIdentity('62A0CEB4-0403-4AA6-A6CD-1EE808AD4D23'), 'About us', 'This is content of the page "ABOUT US"', 'about-us', null, null, true
        );
    }

    public function findByIdentity(PageIdentity $pageId)
    {
        foreach ($this->pages as $page) {
            if ($pageId == $page->getId()) {
                return $page;
            }
        }

        throw new NotFoundHttpException('Not Found');
    }

    public function findBySlug($slug)
    {
        foreach ($this->pages as $page) {
            if ($slug == $page->getSlug()) {
                return $page;
            }
        }

        throw new NotFoundHttpException('Not Found');
    }

    public function findAll()
    {
        return $this->pages;
    }

    public function add(Page $page)
    {
    }

    public function remove(Page $page)
    {
    }
}