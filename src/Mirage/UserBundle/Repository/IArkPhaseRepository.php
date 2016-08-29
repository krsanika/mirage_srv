<?php
/**
 * Created by PhpStorm.
 * User: JF_WS00
 * Date: 2016-08-27
 * Time: 오후 7:33
 */

namespace Mirage\UserBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Doctrine\ORM\Query\ResultSetMapping;

class IArkPhaseRepository extends EntityRepository
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

    public function loadArkPhaseByIdIArk($deck)
    {
        $enterArk=null;

        foreach($deck->getArkPos() as $position => $ark)
        {
            if(isset($ark))
            {
                $query = $this->createQueryBuilder('q')
                    ->where('q.idIArk = :idIArk')
                    ->andWhere('q.isEnabled = 1')
                    ->setParameter('idIArk', $ark->getId())
                    ->getQuery();

                $arkPhases = $query->getResult();
                foreach($arkPhases as $arkPhase)
                {
                    $arkPhase->deleteIArk();
                }
//                $arkPhases[0]->deleteIArk();
                $enterArk[$ark->getId()] = $arkPhases;
            }
        }

        return $enterArk;
    }
}