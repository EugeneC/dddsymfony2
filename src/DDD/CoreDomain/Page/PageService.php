<?php

namespace DDD\CoreDomain\Page;

/**
 * Class PageService
 *
 * @package \DDD\CoreDomain\Page\PageService
 */
class PageService
{
    /**
     * @var \DDD\CoreDomain\Page\PageRepository
     */
    protected $pageRepository;

    /**
     * @param \DDD\CoreDomain\Page\PageRepository $pageRepository
     */
    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    public function add($title, $body, $slug, $status, $tagDescription, $tagKeywords)
    {
        $tags   = new Tags($tagDescription, $tagKeywords);
        $status = new Status($status);
        $page   = new Page(
            $title, $body, $slug, $tags, $status
        );
        $this->pageRepository->save($page);
    }

    public function findPublishedBySlug($pageSlug)
    {
        $page = $this->pageRepository->findOneBy(['slug' => $pageSlug, 'status' => new Status(Statuses::PUBLISH)]);
        if (!$page) {
            throw new PublishedPageNotFoundException("Published page not found");
        }

        return $page;
    }

    public function generateStartPages()
    {
        /** Contacts page **/
        $newPageTitle          = 'Contacts page';
        $newPageBody           = 'Welcome to Contacts Page';
        $newPageSlug           = 'contacts';
        $newPageTagDescription = null;
        $newPageTagKeywords    = null;

        $this->add($newPageTitle, $newPageBody, $newPageSlug, Statuses::PUBLISH, $newPageTagDescription, $newPageTagKeywords);

        /** Home page **/
        $homePageTitle          = 'Home page';
        $homePageBody           = 'Welcome to Home Page';
        $homePageSlug           = 'home';
        $homePageTagDescription = null;
        $homePageTagKeywords    = null;

        $this->add($homePageTitle, $homePageBody, $homePageSlug, Statuses::PUBLISH, $homePageTagDescription, $homePageTagKeywords);

        /** About page **/
        $aboutUsPageTitle          = 'About us';
        $aboutUsPageBody           = 'This is content of the page "ABOUT US"';
        $aboutUsPageSlug           = 'about-us';
        $aboutUsPageTagDescription = null;
        $aboutUsPageTagKeywords    = null;

        $this->add($aboutUsPageTitle, $aboutUsPageBody, $aboutUsPageSlug, Statuses::DRAFT, $aboutUsPageTagDescription, $aboutUsPageTagKeywords);
    }
}