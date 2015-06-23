<?php

namespace DDD\CoreDomainBundle\Repository;

use DDD\CoreDomain\User\User;
use DDD\CoreDomain\User\UserIdentity;
use DDD\CoreDomain\User\UserRepository;
use Doctrine\ODM\MongoDB\DocumentRepository;

/**
 * MongoUserRepository
 *
 */
class MongoUserRepository extends DocumentRepository implements UserRepository
{
    public function findByIdentity(UserIdentity $userId)
    {
        return $this->findOneBy(array('id' => $userId->getValue()));
    }

    public function save(User $user)
    {
        $dm = $this->getDocumentManager();
        $dm->persist($user);

        return $dm->flush();
    }

    public function remove(User $user)
    {
        $dm = $this->getDocumentManager();
        $dm->remove($user);

        return $dm->flush();
    }
}