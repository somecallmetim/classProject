<?php
/**
 * Created by PhpStorm.
 * User: timbauer
 * Date: 3/11/17
 * Time: 3:42 PM
 */

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function findOneByUsername($username)
    {
        return $this->createQueryBuilder('userTable')
            ->andWhere('userTable.username = :username')
            ->setParameter('username', $username)
            ->getQuery()
            ->execute();

    }
}