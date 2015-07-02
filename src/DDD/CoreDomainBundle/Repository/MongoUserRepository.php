<?php

namespace DDD\CoreDomainBundle\Repository;

use DDD\CoreDomain\User\User;
use DDD\CoreDomain\User\UserIdentity;
use DDD\CoreDomain\User\UserRepositoryInterface;
use Doctrine\ODM\MongoDB\DocumentRepository;

/**
 * Class MongoUserRepository
 */
class MongoUserRepository extends DocumentRepository implements UserRepositoryInterface
{
    /**
     * @param UserIdentity $userId
     *
     * @return User
     */
    public function findByIdentity(UserIdentity $userId)
    {
        return $this->findOneBy(array('id' => $userId->getValue()));
    }

    /**
     * @param User $user
     */
    public function save(User $user)
    {
        $dm = $this->getDocumentManager();
        $dm->persist($user);
        $dm->flush();
    }

    /**
     * @param User $user
     */
    public function remove(User $user)
    {
        $dm = $this->getDocumentManager();
        $dm->remove($user);
        $dm->flush();
    }
}