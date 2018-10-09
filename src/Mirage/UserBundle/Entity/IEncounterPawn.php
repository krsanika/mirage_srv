<?php

namespace Mirage\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\Type as JMSType;
use Doctrine\ORM\Mapping as ORM;

/**
 * IEncounterPawn
 *
 * @ORM\Table(name="IEncounterPawn")
 * @ORM\Entity
 */
class IEncounterPawn
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="IEncounter", inversedBy="pawns")
     * @ORM\JoinColumn(name="idIEncounter", referencedColumnName="id")
     *
     */
    private $idIEncounter;

    /**
     * @var integer
     *
     * @ORM\Column(name="idIArk", type="integer", nullable=true)
     */
    private $idIArk;

    /**
     * @var integer
     *
     * @ORM\Column(name="idIArkPhase", type="integer", nullable=true)
     */
    private $idIArkPhase;


    /**
     * @var integer
     *
     * @ORM\Column(name="idPhase", type="integer", nullable=true)
     */
    private $idPhase;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isPlayer", type="integer", nullable=true)
     */
    private $isPlayer;

    /**
     * @var integer
     *
     * @ORM\Column(name="lv", type="integer", nullable=true)
     */
    private $lv =1;

    /**
     * @var integer
     *
     * @ORM\Column(name="hp", type="integer", nullable=false)
     */
    private $hp = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="hpMax", type="integer", nullable=false)
     */
    private $hpMax = 0;
    /**
     * @var integer
     *
     * @ORM\Column(name="atk", type="integer", nullable=false)
     */
    private $atk = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="def", type="integer", nullable=false)
     */
    private $def = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="agi", type="integer", nullable=false)
     */
    private $agi = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="con", type="integer", nullable=false)
     */
    private $con = 0;
    /**
     * @var integer
     *
     * @ORM\Column(name="hpMaxOrigin", type="integer", nullable=false)
     */
    private $hpMaxOrigin = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="atkOrigin", type="integer", nullable=false)
     */
    private $atkOrigin = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="defOrigin", type="integer", nullable=false)
     */
    private $defOrigin = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="agiOrigin", type="integer", nullable=false)
     */
    private $agiOrigin = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="conOrigin", type="integer", nullable=false)
     */
    private $conOrigin = 0;


    /**
     * @var integer
     *
     * @ORM\Column(name="skill1Lv", type="tinyint", nullable=false, columnDefinition="unsigned")
     */
    private $skill1Lv = 1;

    /**
     * @var integer
     *
     * @ORM\Column(name="skill2Lv", type="tinyint", nullable=false, columnDefinition="unsigned")
     */
    private $skill2Lv = 1;

    /**
     * @var integer
     *
     * @ORM\Column(name="skill3Lv", type="tinyint", nullable=false, columnDefinition="unsigned")
     */
    private $skill3Lv = 1;

    /**
     * @var integer
     *
     * @ORM\Column(name="skill4Lv", type="tinyint", nullable=false, columnDefinition="unsigned")
     */
    private $skill4Lv = 1;

    /**
     * @var integer
     *
     * @ORM\Column(name="skill5Lv", type="tinyint", nullable=false, columnDefinition="unsigned")
     */
    private $skill5Lv = 1;

    /**
     * @var integer
     *
     * @ORM\Column(name="delay", type="integer", nullable=true)
     */
    private $delay;

    /**
     * @var tinyint
     *
     * @ORM\Column(name="isDead", type="tinyint", nullable=true)
     */
    private $isDead;

    /**
     * @var integer
     *
     * @ORM\Column(name="created", type="integer", nullable=false)
     */
    private $created;

    /**
     * @var integer
     *
     * @ORM\Column(name="updated", type="integer", nullable=false)
     */
    private $updated;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isEnabled", type="boolean", nullable=false)
     */
    private $isEnabled;

    /**
     * @var integer
     *
     * @ORM\Column(name="dressUp", type="integer", nullable=false)
     */
    private $dressUp;

    /**
     * @var string
     *
     * @ORM\Column(name="position", type="string", nullable=false)
     */
    private $position;

    /**
     * @var \IEncounterPawnStatus
     * @ORM\OneToMany(targetEntity="IEncounterPawnStatus", mappedBy="idIEncounterPawn")
     *
     */

    private $status = array();


    private $skills = array();

    private $tags = array();


    /**
     * IEncounterPawn constructor.
     * @param int $id
     * @param int $idIEncounter
     * @param int $idIArk
     * @param int $idIArkPhase
     * @param bool $isPlayer
     * @param int $lv
     * @param int $hp
     * @param int $hpMax
     * @param int $atk
     * @param int $def
     * @param int $Con
     * @param int $hpMaxOrigin
     * @param int $atkOrigin
     * @param int $defOrigin
     * @param int $spdOrigin
     * @param int $ConOrigin
     * @param int $delay
     * @param tinyint $isDead
     * @param int $created
     * @param int $updated
     * @param bool $isEnabled
     * @param int $dressUp
     * @param string $position
     */
    public function __construct($iEncounter, $now)
    {
        $this->idIEncounter = $iEncounter;
        $this->delay = 0;
        $this->isDead = false;
        $this->created = $now;
        $this->updated = $now;
        $this->isEnabled = true;
        $this->status = new ArrayCollection();
        $this->skills = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }

    public function createFromIArkPhase(IArkPhase $iArkPhase, $phase, $posStr){
        $this->idIArk = $iArkPhase->getIdIArk()->getId();
        $this->idIArkPhase = $iArkPhase->getId();
        $this->idPhase = $iArkPhase->getIdPhase();
        $this->isPlayer = true;
        $this->lv = $iArkPhase->getLv();
        $this->hp = $iArkPhase->getHp();
        $this->hpMax = $iArkPhase->getHpMax();
        $this->atk = $iArkPhase->getAtk();
        $this->def = $iArkPhase->getDef();
        $this->agi = $iArkPhase->getAgi();
        $this->con = $iArkPhase->getCon();
        $this->skill1Lv = $iArkPhase->getSkill1Lv();
        $this->skill2Lv = $iArkPhase->getSkill2Lv();
        $this->skill3Lv = $iArkPhase->getSkill3Lv();
        $this->skill4Lv = $iArkPhase->getSkill4Lv();
        $this->skill5Lv = $iArkPhase->getSkill5Lv();
        $this->hpMaxOrigin = $iArkPhase->getHpMaxOrigin();
        $this->atkOrigin = $iArkPhase->getAtkOrigin();
        $this->defOrigin = $iArkPhase->getDefOrigin();
        $this->agiOrigin = $iArkPhase->getAgiOrigin();
        $this->conOrigin = $iArkPhase->getConOrigin();
        $this->dressUp = $iArkPhase->getDressUp();
        $this->position = $posStr;

        $this->setTagsIndex($phase->getTags());
    }

    public function createFromEnemy($enemy, $phase, $posStr){
        $this->idIArk = $enemy->getArk()->getIdArk();
        $this->idIArkPhase = null;
        $this->idPhase = $enemy->getIdPhase();
        $this->isPlayer = false;
        $this->lv = $enemy->getLv();
        $this->hp = $phase->getHp() + $enemy->getModify()->getHp();
        $this->hpMax = $phase->getHp() + $enemy->getModify()->getHp();
        $this->atk = $phase->getAtk() + $enemy->getModify()->getAtk();
        $this->def = $phase->getDef() + $enemy->getModify()->getDef();
        $this->agi = $phase->getAgi() + $enemy->getModify()->getAgi();
        $this->con = $phase->getCon() + $enemy->getModify()->getCon();

        $this->skill1Lv = 1;// $enemy->getSkill1Lv();
        $this->skill2Lv = 1;// $enemy->getSkill2Lv();
        $this->skill3Lv = 1;// $enemy->getSkill3Lv();
        $this->skill4Lv = 1;// $enemy->getSkill4Lv();
        $this->skill5Lv = 1;// $enemy->getSkill5Lv();
        $this->hpMaxOrigin = $phase->getHp() + $enemy->getModify()->getHp();
        $this->atkOrigin = $phase->getAtk() + $enemy->getModify()->getAtk();
        $this->defOrigin = $phase->getDef() + $enemy->getModify()->getDef();
        $this->agiOrigin =  $phase->getAgi() + $enemy->getModify()->getAgi();
        $this->conOrigin = $phase->getCon() + $enemy->getModify()->getCon();
        $this->dressUp = $enemy->getDressUp();
//        if($enemy->get)
//        $oriPos = substr($posStr, 1,1);
        $this->position = $posStr;
//        str_replace((string)$oriPos, (string)5-$oriPos, $posStr);
        $this->setTagsIndex($phase->getTags());

    }



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idIEncounter
     *
     * @param integer $idIEncounter
     *
     * @return IEncounterPawn
     */
    public function setIdIEncounter($idIEncounter)
    {
        $this->idIEncounter = $idIEncounter;

        return $this;
    }

    /**
     * Get idIEncounter
     *
     * @return integer
     */
    public function getIdIEncounter()
    {
        return $this->idIEncounter;
    }

    /**
     * Set idIArk
     *
     * @param integer $idIArk
     *
     * @return IEncounterPawn
     */
    public function setIdIArk($idIArk)
    {
        $this->idIArk = $idIArk;

        return $this;
    }

    /**
     * Get idIArk
     *
     * @return integer
     */
    public function getIdIArk()
    {
        return $this->idIArk;
    }

    /**
     * Set idIArkPhase
     *
     * @param integer $idIArkPhase
     *
     * @return IEncounterPawn
     */
    public function setIdIArkPhase($idIArkPhase)
    {
        $this->idIArkPhase = $idIArkPhase;

        return $this;
    }

    /**
     * Get idIArkPhase
     *
     * @return integer
     */
    public function getIdIArkPhase()
    {
        return $this->idIArkPhase;
    }

    /**
     * @return int
     */
    public function getIdPhase()
    {
        return $this->idPhase;
    }

    /**
     * @param int $idPhase
     */
    public function setIdPhase($idPhase)
    {
        $this->idPhase = $idPhase;
    }



    /**
     * @return boolean
     */
    public function isPlayer()
    {
        return $this->isPlayer;
    }

    /**
     * @param boolean $isPlayer
     */
    public function setIsPlayer($isPlayer)
    {
        $this->isPlayer = $isPlayer;
    }

    /**
     * @return int
     */
    public function getLv()
    {
        return $this->lv;
    }

    /**
     * @param int $lv
     */
    public function setLv($lv)
    {
        $this->lv = $lv;
    }

    /**
     * @return int
     */
    public function getHp()
    {
        return $this->hp;
    }

    /**
     * @param int $hp
     */
    public function setHp($hp)
    {
        $this->hp = $hp;
    }

    /**
     * @return int
     */
    public function getHpMax()
    {
        return $this->hpMax;
    }

    /**
     * @param int $hpMax
     */
    public function setHpMax($hpMax)
    {
        $this->hpMax = $hpMax;
    }

    /**
     * @return int
     */
    public function getAtkContainStatus()
    {
        $current = $this->atk;
        //버프관련
        foreach($this->status as $status){
            switch($status->getIdCondition()){
                case 11 :
                    $current += $status->getVolume(); break;
                case 15 :
                    $current -= $status->getVolume(); break;
                case 155 :
                    $current = floor($current+ ($current*$status->getPercent()/100)); break;
                case 159 :
                    $current = floor($current- ($current*$status->getPercent()/100)); break;
                default: break;
            }
        }

        return $current;
    }

    /**
     * @param int $atk
     */
    public function setAtk($atk)
    {
        $this->atk = $atk;
    }

    /**
     * @return int
     */
    public function getDefContainStatus()
    {
        $current = $this->def;
        //버프관련
        foreach($this->status as $status){
            switch($status->getIdCondition()){
                case 12 :
                    $current += $status->getVolume(); break;
                case 16 :
                    $current -= $status->getVolume(); break;
                case 156 :
                    $current = floor($current+ ($current*$status->getPercent()/100)); break;
                case 160 :
                    $current = floor($current- ($current*$status->getPercent()/100)); break;
                default: break;
            }
        }


        return $current;
    }

    /**
     * @param int $def
     */
    public function setDef($def)
    {
        $this->def = $def;
    }

    /**
     * @return int
     */
    public function getAgiContainStatus()
    {
        $current = $this->agi;
        //버프관련
        foreach($this->status as $status){
            switch($status->getIdCondition()){
                case 13 :
                    $current += $status->getVolume(); break;
                case 17 :
                    $current -= $status->getVolume(); break;
                case 157 :
                    $current = floor($current+ ($current*$status->getPercent()/100)); break;
                case 161 :
                    $current = floor($current- ($current*$status->getPercent()/100)); break;
                default: break;
            }
        }


        return $current;
    }

    /**
     * @param int $agi
     */
    public function setAgi($agi)
    {
        $this->agi = $agi;
    }


    public function getConContainStatus(){
        $current = $this->con;
        //버프관련
        foreach($this->status as $status){
            switch($status->getIdCondition()){
                case 14 :
                    $current += $status->getVolume(); break;
                case 18 :
                    $current -= $status->getVolume(); break;
                case 158 :
                    $current = floor($current+ ($current*$status->getPercent()/100)); break;
                case 162 :
                    $current = floor($current- ($current*$status->getPercent()/100)); break;
                default: break;
            }
        }
        return $current;
    }


    /**
     * @param int $Con
     */
    public function setCon($con)
    {
        $this->con = $con;
    }

    /**
     * @return int
     */
    public function getAtk()
    {
        return $this->atk;
    }

    /**
     * @return int
     */
    public function getDef()
    {
        return $this->def;
    }

    /**
     * @return int
     */
    public function getAgi()
    {
        return $this->agi;
    }

    /**
     * @return int
     */
    public function getCon()
    {
        return $this->con;
    }


    /**
     * @return int
     */
    public function getHpMaxOrigin()
    {
        return $this->hpMaxOrigin;
    }

    /**
     * @param int $hpMaxOrigin
     */
    public function setHpMaxOrigin($hpMaxOrigin)
    {
        $this->hpMaxOrigin = $hpMaxOrigin;
    }

    /**
     * @return int
     */
    public function getAtkOrigin()
    {
        return $this->atkOrigin;
    }

    /**
     * @param int $atkOrigin
     */
    public function setAtkOrigin($atkOrigin)
    {
        $this->atkOrigin = $atkOrigin;
    }

    /**
     * @return int
     */
    public function getDefOrigin()
    {
        return $this->defOrigin;
    }

    /**
     * @param int $defOrigin
     */
    public function setDefOrigin($defOrigin)
    {
        $this->defOrigin = $defOrigin;
    }

    /**
     * @return int
     */
    public function getAgiOrigin()
    {
        return $this->spdOrigin;
    }

    /**
     * @param int $agiOrigin
     */
    public function setAgiOrigin($agiOrigin)
    {
        $this->agiOrigin = $agiOrigin;
    }

    /**
     * @return int
     */
    public function getConOrigin()
    {
        return $this->conOrigin;
    }

    /**
     * @param int $ConOrigin
     */
    public function setConOrigin($conOrigin)
    {
        $this->conOrigin = $conOrigin;
    }

    /**
     * @return int
     */
    public function getDressUp()
    {
        return $this->dressUp;
    }

    /**
     * @param int $dressUp
     */
    public function setDressUp($dressUp)
    {
        $this->dressUp = $dressUp;
    }

    /**
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param string $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }


    /**
     * Set delay
     *
     * @param integer $delay
     *
     * @return IEncounterPawn
     */
    public function setDelay($delay)
    {
        $this->delay = $delay;

        return $this;
    }

    /**
     * Get delay
     *
     * @return integer
     */
    public function getDelay()
    {
        return $this->delay;
    }

    /**
     * Set isDead
     *
     * @param tinyint $isDead
     *
     * @return IEncounterPawn
     */
    public function setIsDead($isDead)
    {
        $this->isDead = $isDead;

        return $this;
    }

    /**
     * Get isDead
     *
     * @return tinyint
     */
    public function getIsDead()
    {
        return $this->isDead;
    }

    /**
     * Set created
     *
     * @param integer $created
     *
     * @return IEncounterPawn
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return integer
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param integer $updated
     *
     * @return IEncounterPawn
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return integer
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set isEnabled
     *
     * @param boolean $isEnabled
     *
     * @return IEncounterPawn
     */
    public function setIsEnabled($isEnabled)
    {
        $this->isEnabled = $isEnabled;

        return $this;
    }

    /**
     * Get isEnabled
     *
     * @return boolean
     */
    public function getIsEnabled()
    {
        return $this->isEnabled;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }


    /**
     * @param \IEncounterPawnStatus $status
     */
    public function addStatus($status){
        if($this->status->contains($status)){
            $this->status->add($status);
        }

    }

    /**
     * @return self
     */
    public function removeStatus($status){

        $this->status->removeElement($status);
        return $this;
    }

    /**
     * @return array|ArrayCollection
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * @param array|ArrayCollection $skills
     */
    public function setSkills($skills)
    {
        $this->skills = $skills;
    }

    /**
     * @return array|ArrayCollection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param array|ArrayCollection $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }



//----------------

    /**
     * @return self
     */
    public function unsetForBattle(){
        unset($this->id);
        unset($this->idIArk);
        unset($this->idIArkPhase);
        unset($this->isDead);
        unset($this->idIEncounter);
        unset($this->atkOrigin);
        unset($this->defOrigin);
        unset($this->agiOrigin);
        unset($this->conOrigin);
        unset($this->hpMaxOrigin);
        unset($this->created);
        unset($this->updated);
        unset($this->isEnabled);
        return $this;
    }

    public function setTagsIndex($tags){
        $indexes = [];
        foreach($tags as $key=>$tag){
            $mnm = array("index"=>$tag);
            array_push($indexes, $mnm);
        }
        $this->tags = $indexes;


        return $this;
    }

    public function getAbilityDynamically($ability, $origin){
        if(empty($origin)) $origin = "";
        return $this->{$ability.$origin};
    }

    public function setAbilityDynamically($ability, $origin, $input){
        if(empty($origin)) $origin = "";
        $this->{$ability.$origin} = $input;
        return $this;
    }


    public function getSkillLv($lv){
        return $this->{"skill".$lv."Lv"};
    }

}
