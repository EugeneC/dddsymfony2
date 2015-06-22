<?php

namespace DDD\CoreDomainBundle\Repository;

use DDD\CoreDomain\Page\Page;
use DDD\CoreDomain\Page\PageIdentity;
use DDD\CoreDomain\Page\PageRepository;
use DDD\CoreDomain\Page\PublishedPageNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\ODM\MongoDB\DocumentRepository;

/**
 * MongoPageRepository
 *
 */
class MongoPageRepository extends DocumentRepository implements PageRepository
{
    public function findByIdentity(PageIdentity $pageId)
    {
        return $this->findOneBy(array('id'=>$pageId->getValue()));
    }

    public function save(Page $page)
    {
        $dm = $this->getDocumentManager();
        $dm->persist($page);

        return $dm->flush();
    }

    public function remove(Page $page)
    {
        $dm = $this->getDocumentManager();
        $dm->remove($page);

        return $dm->flush();
    }
}