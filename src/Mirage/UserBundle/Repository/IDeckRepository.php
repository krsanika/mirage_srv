<?php
/**
 * Created by PhpStorm.
 * User: JF_WS00
 * Date: 2016-08-21
 * Time: 오전 1:14
 */

namespace Mirage\UserBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Doctrine\ORM\Query\ResultSetMapping;


class IDeckRepository extends EntityRepository
{


    public function loadArkByIdIDeck($idIDeck, $idPlayer)
    {
        $query = $this->createQueryBuilder('q')
            ->where('q.id = :id')
            ->andWhere('q.idPlayer = :idPlayer')
            ->andWhere('q.isEnabled = 1')
            ->setParameter('id', $idIDeck)
            ->setParameter('idPlayer', $idPlayer)
            ->getQuery();

        $arks = $query->getSingleResult();

        return $arks;
    }
}