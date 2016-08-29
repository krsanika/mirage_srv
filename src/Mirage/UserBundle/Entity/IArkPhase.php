<?php

namespace Mirage\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IArkPhase
 *
 * @ORM\Table(name="IArkPhase", indexes={@ORM\Index(name="FK_IArkPhase_Player", columns={"idPlayer"}), @ORM\Index(name="FK_IArkPhase_IArk", columns={"idIArk"})})
 * @ORM\Entity(repositoryClass="Mirage\UserBundle\Repository\IArkPhaseRepository")
 */
class IArkPhase
{
    public function __construct() {
        $now = time();
        $this->created = $now;
        $this->updated = $now;
        $this->isEnable = false;
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
     * @ORM\Column(name="idArkPhase", type="integer", nullable=false)
     */
    private $idArkPhase = '0';

    /**
     * @var tinyint
     *
     * @ORM\Column(name="dressUp", type="tinyint", nullable=false)
     */
    private $dressUp = '0';

    /**
     * @var tinyint
     *
     * @ORM\Column(name="atk", type="tinyint", nullable=false)
     */
    private $atk = '0';

    /**
     * @var tinyint
     *
     * @ORM\Column(name="def", type="tinyint", nullable=false)
     */
    private $def = '0';

    /**
     * @var tinyint
     *
     * @ORM\Column(name="spd", type="tinyint", nullable=false)
     */
    private $spd = '0';

    /**
     * @var tinyint
     *
     * @ORM\Column(name="luk", type="tinyint", nullable=false)
     */
    private $luk = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="accrueCountBattle", type="integer", nullable=false)
     */
    private $accrueCountBattle = '0';

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
     * Set idArkPhase
     *
     * @param integer $idArkPhase
     *
     * @return IArkPhase
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
     * Set spd
     *
     * @param tinyint $spd
     *
     * @return IArkPhase
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
     * @return IArkPhase
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
     * Set idIArk
     *
     * @param \Mirage\UserBundle\Entity\IArk $idIArk
     *
     * @return IArkPhase
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


    public function useBattle()
    {
        $a = $this->getUpdated();
        unset($this->id);
        unset($this->created);
        unset($this->updated);
        unset($this->isEnabled);
        return $this;
    }

    public function deleteIArk()
    {
        unset($this->idIArk);
        return $this;
    }

}
