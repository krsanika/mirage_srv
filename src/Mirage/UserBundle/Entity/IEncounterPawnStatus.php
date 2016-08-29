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
     * @ORM\Column(name="idIEncounterPawn", type="integer", nullable=false)
     */
    private $idIEncounterPawn;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    private $status;

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
     * Set status
     *
     * @param integer $status
     *
     * @return IEncounterPawnStatus
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
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
    public function getIsEnabled()
    {
        return $this->isEnabled;
    }
}
