<?php

namespace DDD\CoreDomainBundle\Repository;

use DDD\CoreDomain\Page\Page;
use DDD\CoreDomain\Page\PageIdentity;
use DDD\CoreDomain\Page\PageRepositoryInterface;
use Doctrine\ODM\MongoDB\DocumentRepository;

/**
 * MongoPageRepository
 *
 */
class MongoPageRepository extends DocumentRepository implements PageRepositoryInterface
{
    /**
     * @param PageIdentity $pageId
     *
     * @return object
     */
    public function findByIdentity(PageIdentity $pageId)
    {
        return $this->findOneBy(array('id' => $pageId->getValue()));
    }

    /**
     * @param Page $page
     */
    public function save(Page $page)
    {
        $dm = $this->getDocumentManager();
        $dm->persist($page);
        $dm->flush();
    }

    /**
     * @param Page $page
     */
    public function remove(Page $page)
    {
        $dm = $this->getDocumentManager();
        $dm->remove($page);
        $dm->flush();
    }
}