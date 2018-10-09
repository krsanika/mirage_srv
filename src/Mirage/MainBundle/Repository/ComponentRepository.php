<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-09-08
 * Time: 오전 5:51
 */

namespace Mirage\MainBundle\Repository;


use Doctrine\ODM\MongoDB\DocumentRepository;
use Mirage\MainBundle\Document\Component;
use Doctrine\ORM\NoResultException;

class ComponentRepository extends DocumentRepository
{
    public function findOneByComponentId($componentId)
    {
        try {
            return $this->dm->getRepository(Component::class)->findOneBy(['parts.componentId' => $componentId]);

        } catch (NoResultException $e) {
            return $e;
        }
    }

    public function findPartByComponentId($componentId){
        $component = $this->findOneByComponentId($componentId);
        if(get_class($component) != 'NoResultException'){
            foreach($component->getParts() as $part){
                if($part->getComponentId() == $componentId) return $part;
            }
        }else return $component;
    }

    public function findAllWithIsHad($idPlayer){
        global $kernel;
        try{
            $all = $this->findAll();

            $iComponents = $kernel->getContainer()->get('doctrine')->getRepository('MirageUserBundle:IItem')->findOnlyComponents($idPlayer);

            foreach($all as &$component){
                foreach($component->getParts() as &$part){
                    foreach($iComponents as $iCom){
                        if($iCom->getIdItem() == $part->getComponentId()){
                            $part->setIsHad(true);
                        }
                    }
                }
            }
            return $all;
        }catch(NoResultException $e){
            return $e;
        }
    }

}