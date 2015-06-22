<?php

namespace DDD\CoreDomain\Page;

interface PageRepository
{
    public function findByIdentity(PageIdentity $pageId);

    public function save(Page $page);

    public function remove(Page $page);
}