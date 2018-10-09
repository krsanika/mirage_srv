<?php

namespace Mirage\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Mirage\MainBundle\Game\GameConfig;
use Mirage\UserBundle\Entity\IArk;
use JMS\Serializer\Annotation\SerializedName;

/**
 * IArkPhase
 *
 * @ORM\Table(name="IArkPhase", indexes={@ORM\Index(name="FK_IArkPhase_Player", columns={"idPlayer"}), @ORM\Index(name="FK_IArkPhase_IArk", columns={"idIArk"})})
 * @ORM\Entity(repositoryClass="Mirage\UserBundle\Repository\IArkPhaseRepository")
 */
class IArkPhase
{


    public function __construct($phase, $time) {
        $this->idPhase = $phase->getIdPhase();
        $this->hp = GameConfig::$BIRTH_HP[$phase->getType()];
        $this->hpMax = GameConfig::$BIRTH_HP[$phase->getType()];
        $this->hpMaxOrigin = GameConfig::$BIRTH_HP[$phase->getType()];
        $this->atk = $phase->getAtk();
        $this->def = $phase->getDef();
        $this->agi = $phase->getAgi();
        $this->con = $phase->getCon();
        $this->atkOrigin = $phase->getAtk();
        $this->defOrigin = $phase->getDef();
        $this->agiOrigin = $phase->getAgi();
        $this->conOrigin = $phase->getCon();
        $this->skillOpen = $phase->getGrade();
        for($i = 1; $i > $this->skillOpen; $i++){
            if($i > $this->skillOpen) ${'$this->skill'.$i.'Lv'} = 0;
            else ${'$this->skill'.$i.'Lv'} = 1;
        }
        $this->created = $time;
        $this->updated = $time;
        $this->dressUp = 1;
        $this->isEnabled = true;
        $this->slots = new ArrayCollection();
    }
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
     * @ORM\Column(name="idPlayer", type="integer", nullable=false)
     */
    private $idPlayer = 0;


    /**
     * @var integer
     * @ORM\Column(name="idPhase", type="integer", nullable=false)
     * @SerializedName(value="id_phase")
     */
    private $idPhase = 0;


    /**
     * @var tinyint
     *
     * @ORM\Column(name="lv", type="tinyint", nullable=false)
     */
    private $lv = '1';



    /**
     * @var tinyint
     *
     * @ORM\Column(name="lvMax", type="tinyint", nullable=false)
     */
    private $lvMax = '20';

    /**
     * @var tinyint
     *
     * @ORM\Column(name="dressUp", type="tinyint", nullable=false, columnDefinition="unsigned")
     */
    private $dressUp = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="exp", type="integer", nullable=false, columnDefinition="unsigned")
     */
    private $exp = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="hp", type="integer", nullable=false, columnDefinition="unsigned")
     */
    private $hp = 0;

    /**
     * @var smallint
     *
     * @ORM\Column(name="atk", type="smallint", nullable=false, columnDefinition="unsigned")
     */
    private $atk = 0;

    /**
     * @var smallint
     *
     * @ORM\Column(name="def", type="smallint", nullable=false, columnDefinition="unsigned")
     */
    private $def = 0;

    /**
     * @var smallint
     *
     * @ORM\Column(name="agi", type="smallint", nullable=false, columnDefinition="unsigned")
     */
    private $agi = 0;

    /**
     * @var smallint
     *
     * @ORM\Column(name="con", type="smallint", nullable=false, columnDefinition="unsigned")
     */
    private $con = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="hpMax", type="integer", nullable=false, columnDefinition="unsigned")
     */
    private $hpMax = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="hpMaxOrigin", type="integer", nullable=false, columnDefinition="unsigned")
     */
    private $hpMaxOrigin = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="atkOrigin", type="integer", nullable=false, columnDefinition="unsigned")
     */
    private $atkOrigin = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="defOrigin", type="integer", nullable=false, columnDefinition="unsigned")
     */
    private $defOrigin = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="agiOrigin", type="integer", nullable=false, columnDefinition="unsigned")
     */
    private $agiOrigin = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="conOrigin", type="integer", nullable=false, columnDefinition="unsigned")
     */
    private $conOrigin = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="skillOpen", type="tinyint", nullable=false, columnDefinition="unsigned")
     */
    private $skillOpen = 1;

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
     * @ORM\Column(name="accrueCountBattle", type="integer", nullable=false, columnDefinition="unsigned")
     */
    private $accrueCountBattle = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="stackCount", type="integer", nullable=false, columnDefinition="unsigned")
     */
    private $stackCount = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isFavored", type="tinyint", nullable=false)
     */
    private $isFavored = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isNew", type="tinyint", nullable=false)
     */
    private $isNew = 1;

    /**
     * @var integer
     *
     * @ORM\Column(name="created", type="integer", nullable=false, columnDefinition="unsigned")
     */
    private $created;

    /**
     * @var integer
     *
     * @ORM\Column(name="updated", type="integer", nullable=false, columnDefinition="unsigned")
     */
    private $updated;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isEnabled", type="boolean", nullable=false)
     */
    private $isEnabled;

    /**
     * @var \IArk
     *
     * @ORM\ManyToOne(targetEntity="IArk")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idIArk", referencedColumnName="id")
     * })
     */
    private $idIArk;

    protected $position;

    private $slots = array();

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
     * @return int
     */
    public function getIdPlayer()
    {
        return $this->idPlayer;
    }

    /**
     * @param int $idPlayer
     */
    public function setIdPlayer($idPlayer)
    {
        $this->idPlayer = $idPlayer;
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
     * @return tinyint
     */
    public function getLv()
    {
        return $this->lv;
    }

    /**
     * @param tinyint $lv
     */
    public function setLv($lv)
    {
        $this->lv = $lv;
    }

    /**
     * @return tinyint
     */
    public function getLvMax()
    {
        return $this->lvMax;
    }

    /**
     * @param tinyint $lvMax
     */
    public function setLvMax($lvMax)
    {
        $this->lvMax = $lvMax;
    }


    /**
     * Set dressUp
     *
     * @param tinyint $dressUp
     *
     * @return IArkPhase
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
     * Set hp
     *
     * @param integer $hp
     *
     * @return IArkPhase
     */
    public function setHp($hp)
    {
        $this->hp = $hp;

        return $this;
    }

    /**
     * Get hp
     *
     * @return integer
     */
    public function getHp()
    {
        return $this->hp;
    }


    /**
     * Set atk
     *
     * @param tinyint $atk
     *
     * @return IArkPhase
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
     * @return IArkPhase
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
     * Set agi
     *
     * @param smallint $agi
     *
     * @return IArkPhase
     */
    public function setAgi($agi)
    {
        $this->agi = $agi;

        return $this;
    }

    /**
     * Get agi
     *
     * @return smallint
     */
    public function getAgi()
    {
        return $this->agi;
    }

    /**
     * Set luk
     *
     * @param tinyint $con
     *
     * @return IArkPhase
     */
    public function setCon($con)
    {
        $this->con = $con;

        return $this;
    }

    /**
     * @return smallint
     */
    public function getCon()
    {
        return $this->con;
    }

    /**
     * @return int
     */
    public function getAgiOrigin()
    {
        return $this->agiOrigin;
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
     * @param int $conOrigin
     */
    public function setConOrigin($conOrigin)
    {
        $this->conOrigin = $conOrigin;
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
    public function getSkillOpen()
    {
        return $this->skillOpen;
    }

    /**
     * @param int $skillOpen
     */
    public function setSkillOpen($skillOpen)
    {
        $this->skillOpen = $skillOpen;
    }

    /**
     * @return int
     */
    public function getSkill1Lv()
    {
        return $this->skill1Lv;
    }

    /**
     * @param int $skill1Lv
     */
    public function setSkill1Lv($skill1Lv)
    {
        $this->skill1Lv = $skill1Lv;
    }

    /**
     * @return int
     */
    public function getSkill2Lv()
    {
        return $this->skill2Lv;
    }

    /**
     * @param int $skill2Lv
     */
    public function setSkill2Lv($skill2Lv)
    {
        $this->skill2Lv = $skill2Lv;
    }

    /**
     * @return int
     */
    public function getSkill3Lv()
    {
        return $this->skill3Lv;
    }

    /**
     * @param int $skill3Lv
     */
    public function setSkill3Lv($skill3Lv)
    {
        $this->skill3Lv = $skill3Lv;
    }

    /**
     * @return int
     */
    public function getSkill4Lv()
    {
        return $this->skill4Lv;
    }

    /**
     * @param int $skill4Lv
     */
    public function setSkill4Lv($skill4Lv)
    {
        $this->skill4Lv = $skill4Lv;
    }

    /**
     * @return int
     */
    public function getSkill5Lv()
    {
        return $this->skill5Lv;
    }

    /**
     * @param int $skill5Lv
     */
    public function setSkill5Lv($skill5Lv)
    {
        $this->skill5Lv = $skill5Lv;
    }

    /**
     * @return int
     */
    public function getExp()
    {
        return $this->exp;
    }

    /**
     * @param int $exp
     */
    public function setExp($exp)
    {
        $this->exp = $exp;
    }

    /**
     * @return boolean
     */
    public function isIsNew()
    {
        return $this->isNew;
    }

    /**
     * @param boolean $isNew
     */
    public function setIsNew($isNew)
    {
        $this->isNew = $isNew;
    }



    /**
     * Set accrueCountBattle
     *
     * @param integer $accrueCountBattle
     *
     * @return IArkPhase
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
     * @return int
     */
    public function getStackCount()
    {
        return $this->stackCount;
    }

    /**
     * @param int $stackCount
     */
    public function setStackCount($stackCount)
    {
        $this->stackCount = $stackCount;
        return $this;
    }

    public function addStackCount()
    {
        $this->stackCount += 1;
        $this->atk +=1;
        $this->def +=1;
        $this->agi +=1;
        $this->con +=1;
        $this->atkOrigin +=1;
        $this->defOrigin +=1;
        $this->agiOrigin +=1;
        $this->conOrigin +=1;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isIsFavored()
    {
        return $this->isFavored;
    }

    /**
     * @param boolean $isFavored
     */
    public function setIsFavored($isFavored)
    {
        $this->isFavored = $isFavored;
    }




    /**
     * Set created
     *
     * @param integer $created
     *
     * @return IArkPhase
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
     * @return IArkPhase
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
     * @return IArkPhase
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
     * @return \IPhaseSlot
     */
    public function getSlots()
    {
        return $this->slots;
    }

    /**
     * @param \IPhaseSlot $slots
     */
    public function setSlots($slots)
    {
        $this->slots = $slots;
    }



    /**
     * Set idIArk
     *
     * @param \Mirage\UserBundle\Entity\IArk $idIArk
     *
     * @return IArkPhase
     */
    public function setIdIArk(IArk $idIArk = null)
    {
        $this->idIArk = $idIArk;

        return $this;
    }

    /**
     * Get idIArk
     *
     * @return \Mirage\UserBundle\Entity\IArk
     */
    public function getIdIArk()
    {
        return $this->idIArk;
    }


    public function setPosition($position)
    {
        $this->position = $position;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function useBattle()
    {
        $a = $this->getUpdated();
   //     unset($this->id);
//        unset($this->created);
        unset($this->updated);
        unset($this->isEnabled);
        return $this;
    }
    public function useInfo()
    {
        unset($this->updated);
        unset($this->isEnabled);
        foreach($this->slots as $slot)
        {
            $slot->useInfo();
        }
        return $this;
    }

    public function getSkills()
    {
        $result = array();
        array_push($result, $this->skill1Lv);
        array_push($result, $this->skill2Lv);
        array_push($result, $this->skill3Lv);
        array_push($result, $this->skill4Lv);
        array_push($result, $this->skill5Lv);
        return $result;
    }
    public function deleteIArk()
    {
        unset($this->idIArk);
        return $this;
    }

}
