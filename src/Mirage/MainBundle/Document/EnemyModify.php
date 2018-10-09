<?php
/**
 * Created by PhpStorm.
 * User: JF_WS00
 * Date: 2017-02-12
 * Time: 오후 7:19
 */

namespace Mirage\MainBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\Type as JMSType;
/**
 * @MongoDB\EmbeddedDocument
 */
class EnemyModify
{


    /**
     * @MongoDB\Int
     */
    protected $idEnemy;

    /**
     * @MongoDB\Int
     */
    protected $skillActivate;
    /**
     * @MongoDB\Int
     */
    protected $hp;
    /**
     * @MongoDB\Int
     */
    protected $atk;
    /**
     * @MongoDB\Int
     */
    protected $def;
    /**
     * @MongoDB\Int
     */
    protected $agi;
    /**
     * @MongoDB\Int
     */
    protected $con;

    /**
     * @return mixed
     */
    public function getIdEnemy()
    {
        return $this->idEnemy;
    }

    /**
     * @param mixed $idEnemy
     */
    public function setIdEnemy($idEnemy)
    {
        $this->idEnemy = $idEnemy;
    }



    /**
     * @MongoDB\EmbedMany(targetDocument="Mirage\MainBundle\Document\AlterSkill")
     * @JMSType("ArrayCollection<Mirage\MainBundle\Document\AlterSkill>")
     */
    protected $alterSkill = array();

    public function __construct()
    {
        $this->alterSkill = new ArrayCollection();
    }

    /**
     * Set skillActivate
     *
     * @param int $skillActivate
     * @return self
     */
    public function setSkillActivate($skillActivate)
    {
        $this->skillActivate = $skillActivate;
        return $this;
    }

    /**
     * Get skillActivate
     *
     * @return int $skillActivate
     */
    public function getSkillActivate()
    {
        return $this->skillActivate;
    }

    /**
     * @return mixed
     */
    public function getHp()
    {
        return $this->hp;
    }

    /**
     * @param mixed $hp
     */
    public function setHp($hp)
    {
        $this->hp = $hp;
    }

    /**
     * @return mixed
     */
    public function getAtk()
    {
        return $this->atk;
    }

    /**
     * @param mixed $atk
     */
    public function setAtk($atk)
    {
        $this->atk = $atk;
    }

    /**
     * @return mixed
     */
    public function getDef()
    {
        return $this->def;
    }

    /**
     * @param mixed $def
     */
    public function setDef($def)
    {
        $this->def = $def;
    }

    /**
     * @return mixed
     */
    public function getAgi()
    {
        return $this->agi;
    }

    /**
     * @param mixed $agi
     */
    public function setAgi($agi)
    {
        $this->agi = $agi;
    }

    /**
     * @return mixed
     */
    public function getCon()
    {
        return $this->con;
    }

    /**
     * @param mixed $con
     */
    public function setCon($con)
    {
        $this->con = $con;
    }



    /**
     * @return array
     */
    public function getAlterSkill()
    {
        return $this->alterSkill;
    }


    /**
     * @param array $alterSkill
     */
    public function setAlterSkill($alterSkill)
    {
        $this->alterSkill = $alterSkill;
    }

    public function addAlterSkill($skill){
        if($this->alterSkill->contains($skill)){
            $this->alterSkill->add($skill);
        }
        return $this;
    }

    public function removeAlterSkill($skill){
        $this->alterSkill->removeElement($skill);
        return $this;
    }

    public function addSkill(\Mirage\MainBundle\Document\Skill $skill)
    {
        $this->alterSkill[] = $skill;
    }

    public function removeSkill(\Mirage\MainBundle\Document\Skill $skill)
    {
        $this->alterSkill->removeElement($skill);
    }


    //===================
    public function replaceSkill($count)
    {
        return $this->alterSkill[$count];
    }
}