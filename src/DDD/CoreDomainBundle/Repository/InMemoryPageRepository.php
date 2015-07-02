<?php

namespace DDD\CoreDomainBundle\Repository;

use DDD\CoreDomain\Page\Page;
use DDD\CoreDomain\Page\PageIdentity;
use DDD\CoreDomain\Page\PageRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class InMemoryPageRepository
 *
 * @package DDD\CoreDomainBundle\Repository
 * @SuppressWarnings("unused")
 */
class InMemoryPageRepository implements PageRepositoryInterface
{
    private $pages;

    /**
     * Generate predefined pages
     */
    public function __construct()
    {
        $this->pages[] = new Page(
            new PageIdentity('8CE05088-ED1F-43E9-A415-3B3792655A9B'), 'Home page', 'Welcome to Home Page', 'home', null, null, true
        );
        $this->pages[] = new Page(
            new PageIdentity('62A0CEB4-0403-4AA6-A6CD-1EE808AD4D23'), 'About us', 'This is content of the page "ABOUT US"', 'about-us', null, null, true
        );
    }

    /**
     * @param PageIdentity $pageId
     *
     * @return Page
     * @throws NotFoundHttpException
     */
    public function findByIdentity(PageIdentity $pageId)
    {
        foreach ($this->pages as $page) {
            if ($pageId == $page->getId()) {
                return $page;
            }
        }

        throw new NotFoundHttpException('Not Found');
    }

    /**
     * @param string $slug
     *
     * @return Page
     * @throws NotFoundHttpException
     */
    public function findBySlug($slug)
    {
        foreach ($this->pages as $page) {
            if ($slug == $page->getSlug()) {
                return $page;
            }
        }

        throw new NotFoundHttpException('Not Found');
    }

    /**
     * @return array
     */
    public function findAll()
    {
        return $this->pages;
    }

    /**
     * @param Page $page
     */
    public function add(Page $page)
    {
    }

    /**
     * @param Page $page
     *
     * @return mixed
     */
    public function remove(Page $page)
    {
    }

    /**
     * @param Page $page
     *
     * @return mixed
     */
    public function save(Page $page)
    {
    }
}