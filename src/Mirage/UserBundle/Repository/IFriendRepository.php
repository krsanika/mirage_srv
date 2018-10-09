<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-04-05
 * Time: 오후 3:12
 */

namespace Mirage\UserBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Mirage\MainBundle\Game\GameConfig;

use Doctrine\ORM\NoResultException;

class IFriendRepository extends EntityRepository
{

    public function findByIdPlayerWithSupportPhases($idPlayer)
    {

        $result = $this->getEntityManager()->createQuery(
            'SELECT f.idFriend, f.callCount, f.isAccepted, f.created, f.updated, p.name,
                    h1.idArkPhase as frontIdIArkPhase, h1.lv as frontLv,
                    h2.idArkPhase as midIdIArkPhase, h2.lv as midLv,
                    h3.idArkPhase as backIdIArkPhase, h3.lv as backLv
             FROM MirageUserBundle:IFriend f '.
            'JOIN MirageUserBundle:Player p WITH f.idFriend = p.id '.
            'JOIN MirageUserBundle:IArkPhase h1 WITH p.frontIArkPhase = h1.id '.
            'JOIN MirageUserBundle:IArkPhase h2 WITH p.midIArkPhase = h2.id '.
            'JOIN MirageUserBundle:IArkPhase h3 WITH p.backIArkPhase = h3.id '.
            'WHERE f.idPlayer = :idPlayer '.
            'AND f.isEnabled = true')
            ->setParameter('idPlayer', $idPlayer)
            ->getResult();

        return $result;
    }


    public function findByIdFriendWithSupportPhases($idPlayer)
    {
        $result = $this->getEntityManager()->createQuery(
            'SELECT f.idPlayer as idFriend, f.callCount, f.created, f.updated, p.name,
                    h1.idArkPhase as frontIdIArkPhase, h1.lv as frontLv,
                    h2.idArkPhase as midIdIArkPhase, h2.lv as midLv,
                    h3.idArkPhase as backIdIArkPhase, h3.lv as backLv
             FROM MirageUserBundle:IFriend f '.
            'JOIN MirageUserBundle:Player p WITH f.idPlayer = p.id '.
            'JOIN MirageUserBundle:IArkPhase h1 WITH p.frontIArkPhase = h1.id '.
            'JOIN MirageUserBundle:IArkPhase h2 WITH p.midIArkPhase = h2.id '.
            'JOIN MirageUserBundle:IArkPhase h3 WITH p.backIArkPhase = h3.id '.
            'WHERE f.idFriend = :idPlayer '.
            'AND f.isEnabled = true '.
            'AND f.isAccepted = false')
            ->setParameter('idPlayer', $idPlayer)
            ->getResult();

        return $result;

    }

    public function findForSupportWithFriend($idPlayer){

        $result = $this->getEntityManager()->createQuery(
            'SELECT p.id as idFriend, f.callCount, p.lastLogin, p.name,
                    h1.idArkPhase as frontIdIArkPhase, h1.lv as frontLv,
                    h2.idArkPhase as midIdIArkPhase, h2.lv as midLv,
                    h3.idArkPhase as backIdIArkPhase, h3.lv as backLv
             FROM MirageUserBundle:IFriend f '.
            'JOIN MirageUserBundle:Player p WITH f.idFriend = p.id '.
            'JOIN MirageUserBundle:IArkPhase h1 WITH p.frontIArkPhase = h1.id '.
            'JOIN MirageUserBundle:IArkPhase h2 WITH p.midIArkPhase = h2.id '.
            'JOIN MirageUserBundle:IArkPhase h3 WITH p.backIArkPhase = h3.id '.
            'WHERE f.idPlayer = :idPlayer '.
            'AND f.isEnabled = true '.
            'AND f.isAccepted = true '.
            'ORDER BY f.updated ASC ')
            ->setParameter('idPlayer', $idPlayer)
            ->setMaxResults(GameConfig::BATTLE_FRIEND_LIMIT)
            ->getResult();

        shuffle($result);



        return $result;


    }

    public function findForSupportWithoutFriend($idPlayer, $count){

        $qb1 = $this->getEntityManager()->createQueryBuilder();
        $sub = $qb1
            ->select('f.idFriend')
            ->from('MirageUserBundle:IFriend', 'f')
            ->where('f.idPlayer = '.$idPlayer)
            ->getDQL();

        $qb2 = $this->getEntityManager()->createQueryBuilder();
        $main = $qb2
            ->select([
                'p.id AS idFriend', 'p.name', 'p.lastLogin',
                'h1.idArkPhase AS frontIdIArkPhase', 'h1.lv AS frontLv',
                'h2.idArkPhase AS midIdIArkPhase', 'h2.lv AS midLv',
                'h3.idArkPhase AS backIdIArkPhase', 'h3.lv AS backLv' ])
            ->from('MirageUserBundle:Player', 'p')
            ->leftJoin('MirageUserBundle:IArkPhase', 'h1', 'WITH', 'p.frontIArkPhase = h1.id')
            ->leftJoin('MirageUserBundle:IArkPhase', 'h2', 'WITH', 'p.midIArkPhase = h2.id')
            ->leftJoin('MirageUserBundle:IArkPhase', 'h3', 'WITH', 'p.backIArkPhase = h3.id')
            ->where($qb2->expr()->notIn('p.id', $sub))
            ->andwhere($qb2->expr()->neq('p.id', $idPlayer))
            ->orderBy('p.lastLogin', 'ASC')
            ->setMaxResults($count);

        $results = $main->getQuery()->getResult();

        foreach($results as &$result){
            if(empty($result['name'])) $result['name'] = '이름없는자';
            if(empty($result['frontLv'])){
                $result['frontLv'] = 0;
                $result['frontIdIArkPhase'] = 0;
            }
            if(empty($result['midLv'])){
                $result['midLv'] = 0;
                $result['midIdIArkPhase'] = 0;
            }
            if(empty($result['backLv'])){
                $result['backLv'] = 0;
                $result['backIdIArkPhase'] = 0;
            }
            $result['callCount'] = 0;

        }






//        var_dump($result);
        return $results;
    }


}