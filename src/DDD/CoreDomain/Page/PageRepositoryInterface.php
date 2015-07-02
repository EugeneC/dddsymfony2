<?php

namespace DDD\CoreDomain\Page;

/**
 * Interface PageRepositoryInterface
 *
 * @package DDD\CoreDomain\Page
 */
interface PageRepositoryInterface
{
    /**
     * @param PageIdentity $pageId
     *
     * @return mixed
     */
    public function findByIdentity(PageIdentity $pageId);

    /**
     * @param Page $page
     *
     * @return mixed
     */
    public function save(Page $page);

    /**
     * @param Page $page
     *
     * @return mixed
     */
    public function remove(Page $page);
}