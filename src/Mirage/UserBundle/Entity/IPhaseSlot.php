<?php

namespace Mirage\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IPhaseSlot
 *
 * @ORM\Table(name="IPhaseSlot")
 * @ORM\Entity
 */
class IPhaseSlot
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
     * @var tinyint
     *
     * @ORM\Column(name="idSlot", type="tinyint", nullable=false)
     */
    private $idSlot = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="idEquipment", type="integer", nullable=true)
     */
    private $idEquipment = '0';

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
     * @var integer
     * @ORM\Column(name="idIPhase", type="integer", nullable=false)
     */
    private $idIPhase;



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
     * Get idSlot
     *
     * @return tinyint
     */
    public function getIdSlot()
    {
        return $this->idSlot;
    }

    /**
     * Set idSlot
     *
     * @param tinyint $idSlot
     *
     * @return IArkSlot
     */
    public function setIdSlot($idSlot)
    {
        $this->idSlot = $idSlot;

        return $this;
    }

    /**
     * @return int
     */
    public function getIdEquipment()
    {
        return $this->idEquipment;
    }

    /**
     * @param int $idEquipment
     */
    public function setIdEquipment($idEquipment)
    {
        $this->idEquipment = $idEquipment;
    }

    /**
     * @return int
     */
    public function getIdIPhase()
    {
        return $this->idIPhase;
    }

    /**
     * @param int $idIPhase
     */
    public function setIdIPhase($idIPhase)
    {
        $this->idIPhase = $idIPhase;
    }



    /**
     * Set created
     *
     * @param integer $created
     *
     * @return IArkSlot
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
     * @return IArkSlot
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
     * @return IArkSlot
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

    //=====================================

    public function useInfo()
    {
        unset($this->idIPhase);
        unset($this->updated);
        unset($this->isEnabled);
        return $this;
    }
}
