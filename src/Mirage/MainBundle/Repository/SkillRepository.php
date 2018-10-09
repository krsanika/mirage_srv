<?php
/**
 * Created by PhpStorm.
 * User: Krsanika
 * Date: 2017-02-27
 * Time: 오후 6:51
 */

namespace Mirage\MainBundle\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;

class SkillRepository extends DocumentRepository
{

    public function findAll(){
        return $this->findBy(array(), array('idSkill'=>'ASC'));

    }
}