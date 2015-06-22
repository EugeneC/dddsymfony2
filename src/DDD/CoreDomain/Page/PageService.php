<?php

namespace DDD\CoreDomain\Page;

/**
 * DDD\CoreDomain\Page\PageService
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
    
    public function addPublic($title, $body, $slug, $tagDescription, $tagKeywords) {
        $page = $this->add($title, $body, $slug, $tagDescription, $tagKeywords);
        $page->publish();
        $this->pageRepository->save($page);
    }
    
    public function addDraft($title, $body, $slug, $tagDescription, $tagKeywords) {
        $page = $this->add($title, $body, $slug, $tagDescription, $tagKeywords);
        $page->draft();
        $this->pageRepository->save($page);
    }
    
    public function add($title, $body, $slug, $tagDescription, $tagKeywords) {
        $tags = new Tags($tagDescription, $tagKeywords);
        $page = new Page(
            $title, $body, $slug, $tags
        );
        
        return $page;
    }
    
    public function findPublishedBySlug($pageSlug) {
        $page = $this->pageRepository->findOneBy(array('slug'=>$pageSlug, 'status'=>'public'));
        if (!$page) {
            throw new PublishedPageNotFoundException("Published page not found");
        }
        
        return $page;
    }   
}