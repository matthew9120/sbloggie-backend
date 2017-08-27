<?php

namespace AppBundle\Repository;

use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository implements UserLoaderInterface
{
    public function loadUserByUsername($username)
    {
        return $this->createQueryBuilder("user")
            ->where("user.username = :username OR user.email = :email OR user.apiKey = :apiKey")
            ->setParameter("username", $username)
            ->setParameter("email", $username)
            ->setParameter("apiKey", $username)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
