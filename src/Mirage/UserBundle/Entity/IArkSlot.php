<?php

namespace Mirage\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IArkSlot
 *
 * @ORM\Table(name="IArkSlot", indexes={@ORM\Index(name="FK_IArkSlot_IArk", columns={"idIArk"})})
 * @ORM\Entity
 */
class IArkSlot
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
    private $idslot = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="idItem", type="integer", nullable=true)
     */
    private $iditem = '0';

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
     * @var \IArk
     *
     * @ORM\ManyToOne(targetEntity="IArk")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idIArk", referencedColumnName="id")
     * })
     */
    private $idIArk;



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
     * Set idslot
     *
     * @param tinyint $idslot
     *
     * @return IArkSlot
     */
    public function setIdslot($idslot)
    {
        $this->idslot = $idslot;

        return $this;
    }

    /**
     * Get idslot
     *
     * @return tinyint
     */
    public function getIdslot()
    {
        return $this->idslot;
    }

    /**
     * Set iditem
     *
     * @param integer $iditem
     *
     * @return IArkSlot
     */
    public function setIditem($iditem)
    {
        $this->iditem = $iditem;

        return $this;
    }

    /**
     * Get iditem
     *
     * @return integer
     */
    public function getIditem()
    {
        return $this->iditem;
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

    /**
     * Set idIArk
     *
     * @param \Mirage\UserBundle\Entity\IArk $idIArk
     *
     * @return IArkSlot
     */
    public function setIdIArk(\Mirage\UserBundle\Entity\IArk $idIArk = null)
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
}
