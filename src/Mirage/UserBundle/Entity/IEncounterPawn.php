<?php

namespace Mirage\UserBundle\Entity;

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
     * @ORM\Column(name="idIEncounter", type="integer", nullable=false)
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
     * @ORM\Column(name="idArkEnemy", type="integer", nullable=true)
     */
    private $idArkEnemy;

    /**
     * @var integer
     *
     * @ORM\Column(name="idArkPhaseEnemy", type="integer", nullable=true)
     */
    private $idArkPhaseEnemy;

    /**
     * @var integer
     *
     * @ORM\Column(name="currentHp", type="integer", nullable=false)
     */
    private $currentHp = '0';

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
     * Set idArkEnemy
     *
     * @param integer $idArkEnemy
     *
     * @return IEncounterPawn
     */
    public function setIdArkEnemy($idArkEnemy)
    {
        $this->idArkEnemy = $idArkEnemy;

        return $this;
    }

    /**
     * Get idArkEnemy
     *
     * @return integer
     */
    public function getIdArkEnemy()
    {
        return $this->idArkEnemy;
    }

    /**
     * Set idArkPhaseEnemy
     *
     * @param integer $idArkPhaseEnemy
     *
     * @return IEncounterPawn
     */
    public function setIdArkPhaseEnemy($idArkPhaseEnemy)
    {
        $this->idArkPhaseEnemy = $idArkPhaseEnemy;

        return $this;
    }

    /**
     * Get idArkPhaseEnemy
     *
     * @return integer
     */
    public function getIdArkPhaseEnemy()
    {
        return $this->idArkPhaseEnemy;
    }

    /**
     * Set currentHp
     *
     * @param integer $currentHp
     *
     * @return IEncounterPawn
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
}
