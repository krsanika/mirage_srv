<?php

namespace Mirage\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IEncounterPawnStatus
 *
 * @ORM\Table(name="IEncounterPawnStatus")
 * @ORM\Entity
 */
class IEncounterPawnStatus
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
     * @ORM\ManyToOne(targetEntity="IEncounterPawn", inversedBy="status")     *
     * @ORM\JoinColumn(name="idIEncounterPawn", referencedColumnName="id")
     */
    private $idIEncounterPawn;

    /**
     * @var integer
     *
     * @ORM\Column(name="idCondition", type="integer", nullable=false)
     */
    private $idCondition;

    /**
     * @var integer
     *
     * @ORM\Column(name="startTurn", type="integer", nullable=false)
     */
    private $startTurn;

    /**
     * @var integer
     *
     * @ORM\Column(name="duration", type="integer", nullable=false)
     */
    private $duration;

    /**
     * @var integer
     *
     * @ORM\Column(name="volume", type="integer", nullable=false)
     */
    private $volume = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="percent", type="integer", nullable=false)
     */
    private $percent = 0;


    /**
     * @var boolean
     *
     * @ORM\Column(name="isMerit", type="boolean", nullable=false)
     */
    private $isMerit = false;

    /**
     * @var integer
     *
     * @ORM\Column(name="idSubject", type="integer", nullable=false)
     */
    private $idSubject = 0;


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
    private $isEnabled = false;

    /**
     * IEncounterPawnStatus constructor.
     * @param int $idIEncounterPawn
     * @param int $startTurn
     * @param int $duration
     * @param int $created
     * @param int $updated
     * @param bool $isEnabled
     */
    public function __construct($idIEncounterPawn, $startTurn, $duration, $isMerit, $now)
    {
        $this->idIEncounterPawn = $idIEncounterPawn;
        $this->startTurn = $startTurn;
        $this->duration = $duration;
        $this->isMerit = $isMerit;
        $this->volume = 0;
        $this->percent = 0;
        $this->created = $now;
        $this->updated = $now;
        $this->isEnabled = true;
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
     * Set idIEncounterPawn
     *
     * @param integer $idIEncounterPawn
     *
     * @return IEncounterPawnStatus
     */
    public function setIdIEncounterPawn($idIEncounterPawn)
    {
        $this->idIEncounterPawn = $idIEncounterPawn;

        return $this;
    }

    /**
     * Get idIEncounterPawn
     *
     * @return integer
     */
    public function getIdIEncounterPawn()
    {
        return $this->idIEncounterPawn;
    }

    /**
     * @return int
     */
    public function getidCondition()
    {
        return $this->idCondition;
    }

    /**
     * @param int $condition
     */
    public function setidCondition($idCondition)
    {
        $this->idCondition = $idCondition;
    }


    /**
     * Set startTurn
     *
     * @param integer $startTurn
     *
     * @return IEncounterPawnStatus
     */
    public function setStartTurn($startTurn)
    {
        $this->startTurn = $startTurn;

        return $this;
    }

    /**
     * Get startTurn
     *
     * @return integer
     */
    public function getStartTurn()
    {
        return $this->startTurn;
    }

    /**
     * @return int
     */
    public function getEndTurn()
    {
        return $this->endTurn;
    }

    /**
     * @param int $endTurn
     */
    public function setEndTurn($endTurn)
    {
        $this->endTurn = $endTurn;
    }


    /**
     * Set duration
     *
     * @param integer $duration
     *
     * @return IEncounterPawnStatus
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return integer
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @return int
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * @param int $volume
     */
    public function setVolume($volume)
    {
        $this->volume = $volume;
    }

    /**
     * @return int
     */
    public function getPercent()
    {
        return $this->percent;
    }

    /**
     * @param int $percent
     */
    public function setPercent($percent)
    {
        $this->percent = $percent;
    }

    /**
     * @return boolean
     */
    public function isMerit()
    {
        return $this->isMerit;
    }

    /**
     * @param boolean $isMerit
     */
    public function setIsMerit($isMerit)
    {
        $this->isMerit = $isMerit;
    }

    /**
     * @return int
     */
    public function getIdSubject()
    {
        return $this->idSubject;
    }

    /**
     * @param int $idSubject
     */
    public function setIdSubject($idSubject)
    {
        $this->idSubject = $idSubject;
    }



    /**
     * Set created
     *
     * @param integer $created
     *
     * @return IEncounterPawnStatus
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
     * @return IEncounterPawnStatus
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
     * @return IEncounterPawnStatus
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
    public function IsEnabled()
    {
        return $this->isEnabled;
    }

//   --------------------

    public function unsetForBattle(){
        unset($this->id);
        unset($this->idIEncounterPawn);
        unset($this->created);
        unset($this->updated);
        unset($this->isEnabled);
        return $this;
    }

}
