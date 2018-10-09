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
use Doctrine\Common\Collections\ArrayCollection;

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

        foreach($deck->getArkPositionsToArray() as $ark)
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
                    $arkPhase->useBattle();
                }
                $enterArk[$ark->getId()] = $arkPhases;
            }
        }

        return $enterArk;
    }

    public function loadByIdPlayerForDeck($idPlayer)
    {
        $qb1 = $this->getEntityManager()->createQueryBuilder()->select('s')->from('MirageUserBundle:IPhaseSlot','s')->getQuery();
        $allSlots = $qb1->getResult();
        $qb2 =  $this->getEntityManager()->createQueryBuilder()
            ->select('p')
            ->from('MirageUserBundle:IArkPhase','p')
            ->where('p.idPlayer = :idPlayer')
            ->andWhere('p.isEnabled = 1')
            ->setParameter('idPlayer', $idPlayer)
            ->getQuery();

        $phases = $qb2->getResult();

        foreach($phases as $phase)
        {
            $slots = new ArrayCollection();
            foreach($allSlots as $slot)
            {
                if($slot->getIdIPhase() == $phase->getId())
                {
                    $slots->add($slot);
                }
            }
            $phase->setSlots($slots);
        }

        return $phases;
    }
//    public function loadByIdPlayerForDeck($idPlayer)
//    {
//        $query = $this->createQueryBuilder('q')
//            ->select('q.id','q.idPhase as id_phase','q.lv','q.lvMax as lv_max'  ,'q.hp','q.hpMax  as hp_max','q.hpMaxOrigin as hp_max_origin','q.atk','q.def','q.agi','q.con','q.atkOrigin as atk_origin','q.defOrigin as def_origin','q.agiOrigin as agi_origin','q.conOrigin as con_origin','q.skillOpen as skill_open','q.skill1Lv as skill1_lv','q.skill2Lv as skill2_lv','q.skill3Lv as skill3_lv','q.skill4Lv as skill4_lv','q.skill5Lv as skill5_lv','q.dressUp as dress_up','q.accrueCountBattle as accrue_count_battle','q.stackCount as stack_count','q.isFavored as is_favored','q.created')
//            ->andWhere('q.idPlayer = :idPlayer')
//            ->andWhere('q.isEnabled = 1')
//            ->setParameter('idPlayer', $idPlayer)
//            ->getQuery();
//
//        $arks = $query->getArrayResult();
//
//        return $arks;
//    }
}