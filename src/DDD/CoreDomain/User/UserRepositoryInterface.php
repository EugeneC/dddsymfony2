<?php

namespace DDD\CoreDomain\User;

/**
 * Interface UserRepositoryInterface
 *
 * @package DDD\CoreDomain\User
 */
interface UserRepositoryInterface
{
    /**
     * @param UserIdentity $userId
     *
     * @return User
     */
    public function findByIdentity(UserIdentity $userId);

    /**
     * @param User $user
     *
     * @return mixed
     */
    public function save(User $user);

    /**
     * @param User $user
     *
     * @return mixed
     */
    public function remove(User $user);
}