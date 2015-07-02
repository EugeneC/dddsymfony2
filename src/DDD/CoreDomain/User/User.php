<?php
namespace DDD\CoreDomain\User;

use FOS\UserBundle\Document\User as BaseUser;

/**
 * Class User
 *
 * @package DDD\CoreDomain\User
 */
class User extends BaseUser
{
    protected $id;
}