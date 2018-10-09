<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-09-08
 * Time: 오전 5:51
 */

namespace Mirage\MainBundle\Repository;


use Doctrine\ODM\MongoDB\DocumentRepository;
use Mirage\MainBundle\Document\Summon;
use Doctrine\ORM\NoResultException;

class SummonRepository extends DocumentRepository
{
    public function findOneByModeId($modeId)
    {
        try {
            return $this->dm->getRepository(Summon::class)->findOneBy(['summonModes.modeId' => $modeId]);

        } catch (NoResultException $e) {
            return $e;

        }
    }

}