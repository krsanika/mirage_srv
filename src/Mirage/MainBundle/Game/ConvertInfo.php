<?php
/**
 * Created by PhpStorm.
 * User: JF_WS00
 * Date: 2016-08-09
 * Time: 오전 12:23
 */

namespace Mirage\MainBundle\Game;

use Mirage\UserBundle\Controller\Controller;
use Mirage\UserBundle\Entity\IArkPhase;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Mirage\MainBundle\Document\Notification;
class ConvertInfo
{
    /*
    public function __construct($phasesCount)
    {
            $this->phases = new ArkPhaseInfo();
    }

    protected $id;
    protected $idArk;
//    protected $title;
//    protected $origin;
//    protected $description;
    protected $equipmentSlot;
    protected $lv;
    protected $pointRelationship;
    protected $exp;
    protected $phases;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getIdArk()
    {
        return $this->arkId;
    }

    public function setIdArk($idArk)
    {
        $this->arkId = $idArk;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }


    public function getOrigin()
    {
        return $this->origin;
    }

    public function setOrigin($origin)
    {
        $this->origin = $origin;
    }

    public function getEquipmentSlot()
    {
        return $this->equipmentSlot;
    }

    public function setEquipmentSlot($equipmentSlot)
    {
        $this->equipmentSlot = $equipmentSlot;
    }

    public function getLv()
    {
        return $this->lv;
    }

    public function setLv($lv)
    {
        $this->lv = $lv;
    }

    public function getPointRelationship()
    {
        return $this->pointRelationship;
    }

    public function setPointRelationship($pointRelationship)
    {
        $this->pointRelationship = $pointRelationship;

        return $this;
    }

    public function setExp($exp)
    {
        $this->exp = $exp;

        return $this;
    }

    public function getExp()
    {
        return $this->exp;
    }

    public function getPhases()
    {
        return $this->phases;
    }

    public function getPhase($phaseId = null){
        if(empty($phaseId)){
            return $this->phases->first();
        }
        foreach($this->phases as $phase){
            if($phase->getPhaseId() == $phaseId ){
                return $phase;
            }
        }

    }

    public function addPhase(Phase $phase){
        if($this->phases->contains($phase)){
            $this->phases->add($phase);
        }
        return $this;
    }

    public function removePhase($phase){
        $this->phases->removeElement($phase);
        return $this;
    }

    public function setPhases($phases)
    {
        $this->phases = $phases;
    }
  */
    public static function convertArray($encounterInfo, $playerDeck)
    {
        foreach($playerDeck as $key => $value){
            if(!empty($value)){

            }
        }
        return array();
    }
}


class ArkPhaseInfo
{
    public function __construct($skillCount = 5)
    {
        $this->skills = new ArkSkill[$skillCount];
        $this->tags = new ArrayCollection();
    }

    protected $idArkPhase;
    protected $name;
    protected $dressUp;
    protected $currentHp;
    protected $maxHp;
    protected $atk;
    protected $def;
    protected $spd;
    protected $luk;
    protected $skills = array();
    protected $tags = array();
    protected $accrueCountBattle;
    protected $type;

    /**
     * Set idArkPhase
     *
     * @param integer $idArkPhase
     *
     * @return ArkPhaseInfo
     */
    public function setIdArkPhase($idArkPhase)
    {
        $this->idArkPhase = $idArkPhase;

        return $this;
    }

    /**
     * Get idArkPhase
     *
     * @return integer
     */
    public function getIdArkPhase()
    {
        return $this->idArkPhase;
    }

    public function getName(){
        return $this->name;
    }
    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Set dressUp
     *
     * @param tinyint $dressUp
     *
     * @return ArkPhaseInfo
     */
    public function setDressUp($dressUp)
    {
        $this->dressUp = $dressUp;

        return $this;
    }

    /**
     * Get dressUp
     *
     * @return tinyint
     */
    public function getDressUp()
    {
        return $this->dressUp;
    }

    /**
     * Set atk
     *
     * @param tinyint $atk
     *
     * @return ArkPhaseInfo
     */
    public function setAtk($atk)
    {
        $this->atk = $atk;

        return $this;
    }

    /**
     * Get atk
     *
     * @return tinyint
     */
    public function getAtk()
    {
        return $this->atk;
    }

    /**
     * Set def
     *
     * @param tinyint $def
     *
     * @return ArkPhaseInfo
     */
    public function setDef($def)
    {
        $this->def = $def;

        return $this;
    }

    /**
     * Get def
     *
     * @return tinyint
     */
    public function getDef()
    {
        return $this->def;
    }

    /**
     * Set spd
     *
     * @param tinyint $spd
     *
     * @return ArkPhaseInfo
     */
    public function setSpd($spd)
    {
        $this->spd = $spd;

        return $this;
    }

    /**
     * Get spd
     *
     * @return tinyint
     */
    public function getSpd()
    {
        return $this->spd;
    }

    /**
     * Set luk
     *
     * @param tinyint $luk
     *
     * @return ArkPhaseInfo
     */
    public function setLuk($luk)
    {
        $this->luk = $luk;

        return $this;
    }

    /**
     * Get luk
     *
     * @return tinyint
     */
    public function getLuk()
    {
        return $this->luk;
    }

    /**
     * Set accrueCountBattle
     *
     * @param integer $accrueCountBattle
     *
     * @return ArkPhaseInfo
     */
    public function setAccrueCountBattle($accrueCountBattle)
    {
        $this->accrueCountBattle = $accrueCountBattle;

        return $this;
    }

    /**
     * Get accrueCountBattle
     *
     * @return integer
     */
    public function getAccrueCountBattle()
    {
        return $this->accrueCountBattle;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    public function setSkills($arkSkills)
    {
        foreach($arkSkills as $key => $skill){
            $skills[key] = new ArkSkill();
            $skills[key] = $skill;
        }
        $this->skills = $skills;

        return $this;
    }

    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }
    /**
     * @param array $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }
}

class ArkSkill
{
    public function __construct()
    {
    }

    protected $idSkill;
    protected $name;
    protected $effect;
    protected $volume;
    protected $type;
    protected $duration;
    protected $area;
    protected $target;
    protected $consume;
    protected $description;
    protected $isCanUseSkill;
}