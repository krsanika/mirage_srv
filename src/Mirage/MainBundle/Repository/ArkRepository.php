<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-09-08
 * Time: 오전 5:51
 */

namespace Mirage\MainBundle\Repository;


use Doctrine\ODM\MongoDB\DocumentRepository;
use Mirage\MainBundle\Document\Ark;
use Doctrine\ORM\NoResultException;
use Mirage\MainBundle\Game\GameConfig;

class ArkRepository extends DocumentRepository
{
    public function findAll(){
        try{
            return $this->findBy([],['idArk' => 'ASC']);
        }catch (NoResultException $e){
            return $e;
        }
    }

    public function findOneByIdPhase($idPhase)
    {
        try {
            return $this->dm->getRepository(Ark::class)->findOneBy(['phases.IdPhase' => $idPhase]);

        } catch (NoResultException $e) {
            return $e;

        }
    }

    public function searchOnePhaseByIdPhase($idPhase)
    {
        try {
            $ark = $this->dm->getRepository(Ark::class)->findOneBy(['phases.idPhase' => $idPhase]);
            $result = null;
            foreach($ark->getPhases() as $phase){
                if($idPhase == $phase->getIdPhase()){
                    $result = $phase;
                    break;
                }
            }
            return $result;

        } catch (NoResultException $e) {
            return $e;
        }
    }

    public function findOnePhasesByIdPhases($iPhases)
    {
        try {
            $result = array();
            foreach($iPhases as $iPhase )
            {
//                $idPhase = $iPhase['id_phase'];
                $idPhase = $iPhase->getIdPhase();
                $ark = $this->dm->getRepository(Ark::class)->findOneBy(['phases.idPhase' => $idPhase]);

                if($ark != null)
                {
                    foreach($ark->getPhases() as $phase){
                        if($idPhase == $phase->getIdPhase()){
                            if(!in_array ( $idPhase,array_column($result, 'idPhase'))){
                                array_push($result,$phase);
                            }
                            break;
                        }
                    }

                }
            }
            return $result;

        } catch (NoResultException $e) {
            return $e;
        }
    }

    public function findOneArkByIdPhases($iPhases)
    {
        try {
            $result = array();
            foreach($iPhases as $iPhase )
            {
             //   $idPhase = $iPhase['id_phase'];

                $idPhase = $iPhase->getIdPhase();
                $ark = $this->dm->getRepository(Ark::class)->findOneBy(['phases.idPhase' => $idPhase]);

                if($ark != null)
                {
                    array_push($result,$ark);

                }
            }
            return $result;

        } catch (NoResultException $e) {
            return $e;
        }
    }

    public  function  findArkTopInfoByIPhase($iPhase)
    {
        try {
            $result = null;
            $ark = $this->dm->getRepository(Ark::class)->findOneBy(['phases.idPhase' => $iPhase->getIdPhase()]);

            if($ark != null)
            {
                foreach($ark->getPhases() as $phase){
                    if($iPhase->getIdPhase() == $phase->getIdPhase()){
                        $result = array('id_phase'=>$iPhase->getIdPhase(),'lv'=>$iPhase->getLv(),'class_str'=>GameConfig::$TYPESTR_KR[$phase->getType()],'title_str'=>GameConfig::$TITLESTR_KR[$ark->getTitle()]);
                        break;
                    }
                }

            }

            return $result;

        } catch (NoResultException $e) {
            return $e;
        }
    }
}