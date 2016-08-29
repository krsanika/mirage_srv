<?php

namespace Mirage\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Type as JMSType;
/**
 * IArk
 *
 * @ORM\Table(name="IArk", indexes={@ORM\Index(name="FK_IArk_Player", columns={"idPlayer"}), @ORM\Index(name="FK_IArk_IArkPhase", columns={"idCurrentPhase"})})
 * @ORM\Entity(repositoryClass="Mirage\UserBundle\Repository\IArkRepository")
 */
class IArk
{
    public function __construct() {
        $now = time();
        $this->lv = 1;
        $this->created = $now;
        $this->updated = $now;
        $this->isEnabled = false;
        $this->iPhases = new ArrayCollection();
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
     * @ORM\Column(name="idArk", type="integer", nullable=false)
     */
    private $idArk = '0';

    /**
     * @var tinyint
     *
     * @ORM\Column(name="lv", type="tinyint", nullable=false)
     */
    private $lv = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="currentHp", type="integer", nullable=false)
     */
    private $currentHp = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="pointRelationship", type="integer", nullable=false)
     */
    private $pointRelationship = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="exp", type="integer", nullable=false)
     */
    private $exp = '0';

    /**
     * @var tinyint
     *
     * @ORM\Column(name="limitEquipmentSlot", type="tinyint", nullable=false)
     */
    private $limitEquipmentSlot = '0';

    /**
     * @var tinyint
     *
     * @ORM\Column(name="isFavorited", type="tinyint", nullable=false)
     */
    private $isFavorited = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="lastBattleTime", type="integer", nullable=false)
     */
    private $lastBattleTime = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="created", type="integer", nullable=false)
     */
    private $created = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="updated", type="integer", nullable=false)
     */
    private $updated = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="isEnabled", type="boolean", nullable=false)
     */
    private $isEnabled = '0';

    /**
     * @var \IArkPhase
     *
     * @ORM\ManyToOne(targetEntity="IArkPhase")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCurrentPhase", referencedColumnName="id")
     * })
     */
    private $idCurrentPhase;

    /**
     * @var \Player
     *
     * @ORM\ManyToOne(targetEntity="Player")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idPlayer", referencedColumnName="id")
     * })
     */
    private $idPlayer;

    /**
     * @JMSType("Mirage\MainBundle\Document\Ark")
     * @var \Mirage\MainBundle\Document\Ark
     */
    protected $ark;


    /**
     * @var \Mirage\UserBundle\Entity\IArkPhase
     * @JMSType("Mirage\UserBundle\Entity\IArkPhase")
     * @ORM\OneToMany(targetEntity="IArkPhase", mappedBy="idIArk")
     * @ORM\JoinColumn(name="id", referencedColumnName="idIArk")
     */
    protected $iPhases = array();

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
     * Set idArk
     *
     * @param integer $idArk
     *
     * @return IArk
     */
    public function setIdArk($idArk)
    {
        $this->idArk = $idArk;

        return $this;
    }

    /**
     * Get idArk
     *
     * @return integer
     */
    public function getIdArk()
    {
        return $this->idArk;
    }

    /**
     * Set lv
     *
     * @param tinyint $lv
     *
     * @return IArk
     */
    public function setLv($lv)
    {
        $this->lv = $lv;

        return $this;
    }

    /**
     * Get lv
     *
     * @return tinyint
     */
    public function getLv()
    {
        return $this->lv;
    }

    /**
     * Set currentHp
     *
     * @param integer $currentHp
     *
     * @return IArk
     */
    public function setCurrentHp($currentHp)
    {
        $this->currentHp = $currentHp;

        return $this;
    }

    /**
     * Get currentHp
     *
     * @return integer
     */
    public function getCurrentHp()
    {
        return $this->currentHp;
    }

    /**
     * Set pointRelationship
     *
     * @param integer $pointRelationship
     *
     * @return IArk
     */
    public function setPointRelationship($pointRelationship)
    {
        $this->pointRelationship = $pointRelationship;

        return $this;
    }

    /**
     * Get pointRelationship
     *
     * @return integer
     */
    public function getPointRelationship()
    {
        return $this->pointRelationship;
    }

    /**
     * Set exp
     *
     * @param integer $exp
     *
     * @return IArk
     */
    public function setExp($exp)
    {
        $this->exp = $exp;

        return $this;
    }

    /**
     * Get exp
     *
     * @return integer
     */
    public function getExp()
    {
        return $this->exp;
    }

    /**
     * Set limitEquipmentSlot
     *
     * @param tinyint $limitEquipmentSlot
     *
     * @return IArk
     */
    public function setLimitEquipmentSlot($limitEquipmentSlot)
    {
        $this->limitEquipmentSlot = $limitEquipmentSlot;

        return $this;
    }

    /**
     * Get limitEquipmentSlot
     *
     * @return tinyint
     */
    public function getLimitEquipmentSlot()
    {
        return $this->limitEquipmentSlot;
    }

    /**
     * Set isFavorited
     *
     * @param tinyint $isFavorited
     *
     * @return IArk
     */
    public function setIsFavorited($isFavorited)
    {
        $this->isFavorited = $isFavorited;

        return $this;
    }

    /**
     * Get isFavorited
     *
     * @return tinyint
     */
    public function getIsFavorited()
    {
        return $this->isFavorited;
    }

    /**
     * Set lastBattleTime
     *
     * @param integer $lastBattleTime
     *
     * @return IArk
     */
    public function setLastBattleTime($lastBattleTime)
    {
        $this->lastBattleTime = $lastBattleTime;

        return $this;
    }

    /**
     * Get lastBattleTime
     *
     * @return integer
     */
    public function getLastBattleTime()
    {
        return $this->lastBattleTime;
    }

    /**
     * Set created
     *
     * @param integer $created
     *
     * @return IArk
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
     * @return IArk
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
     * @return IArk
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
     * Set idCurrentPhase
     *
     * @param \Mirage\UserBundle\Entity\IArkPhase $idCurrentPhase
     *
     * @return IArk
     */
    public function setIdCurrentPhase(\Mirage\UserBundle\Entity\IArkPhase $idCurrentPhase = null)
    {
        $this->idCurrentPhase = $idCurrentPhase;

        return $this;
    }

    /**
     * Get idCurrentPhase
     *
     * @return \Mirage\UserBundle\Entity\IArkPhase
     */
    public function getIdCurrentPhase()
    {
        return $this->idCurrentPhase;
    }

    /**
     * Set idPlayer
     *
     * @param \Mirage\UserBundle\Entity\Player $idPlayer
     *
     * @return IArk
     */
    public function setIdPlayer(\Mirage\UserBundle\Entity\Player $idPlayer = null)
    {
        $this->idPlayer = $idPlayer;

        return $this;
    }

    /**
     * Get idPlayer
     *
     * @return \Mirage\UserBundle\Entity\Player
     */
    public function getIdPlayer()
    {
        return $this->idPlayer;
    }

    public function unsetPlayer()
    {
        $a = $this->getId();
        unset($this->idPlayer);
        return $this;
    }

    public function useBattle()
    {
        $a = $this->getUpdated();
        if(isset($this->idCurrentPhase))
        {
            $this->idCurrentPhase->useBattle();
        }
        unset($this->id);
        unset($this->idPlayer);
        unset($this->created);
        unset($this->updated);
        unset($this->isEnabled);
        return $this;
    }

    public function deleteInfos()
    {
        $a = $this->getUpdated();
        unset($this->idPlayer);
        unset($this->lv);
        unset($this->idCurrentPhase);
        unset($this->currentHp );
        unset($this->pointRelationship);
        unset($this->exp);
        unset($this->limitEquipmentSlot);
        unset($this->isFavorited);
        unset($this->lastBattleTime );
        unset($this->created);
        unset($this->updated);
        unset($this->isEnabled);
        return $this;
    }

    /**
     * @return \Mirage\MainBundle\Document\Ark
     */
    public function getArk()
    {
        return $this->ark;
    }

    /**
     * @param \Mirage\MainBundle\Document\Ark $ark
     */
    public function setArk($ark)
    {
        $this->ark = $ark;
    }

    /**
     * @return IArkPhase
     */
    public function getIPhases()
    {
        return $this->iPhases;
    }

    /**
     * @param IArkPhase $iPhases
     */
    public function setIPhases($iPhases)
    {
        $this->iPhases = $iPhases;
    }

    public function addIPhase(IArkPhase $iArkPhase){
        if($this->iPhases->contains($iArkPhase)){
            $this->iPhases->add($iArkPhase);
        }
        return $this;
    }

    public function removeIPhase($iArkPhase){
        $this->iPhases->removeElement($iArkPhase);
        return $this;
    }



}
