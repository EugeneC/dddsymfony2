<?php

namespace DDD\CoreDomain\User;

interface UserRepository
{
    public function findByIdentity(UserIdentity $userId);

    public function save(User $user);

    public function remove(User $user);
}