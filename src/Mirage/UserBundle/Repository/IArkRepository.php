<?php
/**
 * Created by PhpStorm.
 * User: JF_WS00
 * Date: 2016-08-21
 * Time: 오전 1:09
 */

namespace Mirage\UserBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Doctrine\ORM\Query\ResultSetMapping;

class IArkRepository  extends EntityRepository
{
    public function loadIArkByIdArk($idArk)
    {
       $fields = array('q.id','q.idArk', 'ap.id', 'q.lv',
           'q.currentHp', 'q.pointRelationship', 'q.exp',
           'q.limitEquipmentSlot', 'q.isFavorited',
           'q.lastBattleTime',
           'q.created', 'q.updated', 'q.isEnabled');
       $qb =  $this->getEntityManager()->createQueryBuilder();

        $query = $qb
            ->select($fields)
            ->from('MirageUserBundle:IArk','q')
            ->Join('q.idCurrentPhase', 'ap', 'WITH', 'ap.id = :id')
            ->where('q.id = :id')
            ->andWhere('q.isEnabled = 1')
            ->setParameter('id',$idArk)
            ->getQuery();

        return $query->getResult();
    }

}