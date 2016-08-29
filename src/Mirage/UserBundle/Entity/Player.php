<?php

namespace Mirage\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Player
 *
 * @ORM\Table(name="Player", indexes={@ORM\Index(name="FK_Player_IDeck", columns={"idMainDeck"})})
 * @ORM\Entity
 */
class Player
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=8, nullable=true)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="lv", type="integer", nullable=true)
     */
    private $lv;

    /**
     * @var integer
     *
     * @ORM\Column(name="exp", type="integer", nullable=true)
     */
    private $exp;

    /**
     * @var integer
     *
     * @ORM\Column(name="jewel", type="integer", nullable=true)
     */
    private $jewel;

    /**
     * @var integer
     *
     * @ORM\Column(name="gold", type="integer", nullable=true)
     */
    private $gold;

    /**
     * @var integer
     *
     * @ORM\Column(name="ap", type="integer", nullable=true)
     */
    private $ap;

    /**
     * @var integer
     *
     * @ORM\Column(name="fp", type="integer", nullable=true)
     */
    private $fp;

    /**
     * @var tinyint
     *
     * @ORM\Column(name="limitInventorySlot", type="tinyint", nullable=true)
     */
    private $limitInventorySlot = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="lastLogin", type="integer", nullable=true)
     */
    private $lastLogin;

    /**
     * @var integer
     *
     * @ORM\Column(name="idFavoredChara", type="integer", nullable=true)
     */
    private $idFavoredChara;

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
    private $isEnabled = '0';

    /**
     * @var \IDeck
     *
     * @ORM\ManyToOne(targetEntity="IDeck")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idMainDeck", referencedColumnName="id")
     * })
     */
    private $idMainDeck;



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
     * Set name
     *
     * @param string $name
     *
     * @return Player
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set lv
     *
     * @param integer $lv
     *
     * @return Player
     */
    public function setLv($lv)
    {
        $this->lv = $lv;

        return $this;
    }

    /**
     * Get lv
     *
     * @return integer
     */
    public function getLv()
    {
        return $this->lv;
    }

    /**
     * Set exp
     *
     * @param integer $exp
     *
     * @return Player
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
     * Set jewel
     *
     * @param integer $jewel
     *
     * @return Player
     */
    public function setJewel($jewel)
    {
        $this->jewel = $jewel;

        return $this;
    }

    /**
     * Get jewel
     *
     * @return integer
     */
    public function getJewel()
    {
        return $this->jewel;
    }

    /**
     * Set gold
     *
     * @param integer $gold
     *
     * @return Player
     */
    public function setGold($gold)
    {
        $this->gold = $gold;

        return $this;
    }

    /**
     * Get gold
     *
     * @return integer
     */
    public function getGold()
    {
        return $this->gold;
    }

    /**
     * Set ap
     *
     * @param integer $ap
     *
     * @return Player
     */
    public function setAp($ap)
    {
        $this->ap = $ap;

        return $this;
    }

    /**
     * Get ap
     *
     * @return integer
     */
    public function getAp()
    {
        return $this->ap;
    }

    /**
     * Set fp
     *
     * @param integer $fp
     *
     * @return Player
     */
    public function setFp($fp)
    {
        $this->fp = $fp;

        return $this;
    }

    /**
     * Get fp
     *
     * @return integer
     */
    public function getFp()
    {
        return $this->fp;
    }

    /**
     * Set limitInventorySlot
     *
     * @param tinyint $limitInventorySlot
     *
     * @return Player
     */
    public function setLimitInventorySlot($limitInventorySlot)
    {
        $this->limitInventorySlot = $limitInventorySlot;

        return $this;
    }

    /**
     * Get limitInventorySlot
     *
     * @return tinyint
     */
    public function getLimitInventorySlot()
    {
        return $this->limitInventorySlot;
    }

    /**
     * Set lastLogin
     *
     * @param integer $lastLogin
     *
     * @return Player
     */
    public function setLastLogin($lastLogin)
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    /**
     * Get lastLogin
     *
     * @return integer
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * Set idFavoredChara
     *
     * @param integer $idFavoredChara
     *
     * @return Player
     */
    public function setIdFavoredChara($idFavoredChara)
    {
        $this->idFavoredChara = $idFavoredChara;

        return $this;
    }

    /**
     * Get idFavoredChara
     *
     * @return integer
     */
    public function getIdFavoredChara()
    {
        return $this->idFavoredChara;
    }

    /**
     * Set created
     *
     * @param integer $created
     *
     * @return Player
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
     * @return Player
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
     * @return Player
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
     * Set idMainDeck
     *
     * @param \Mirage\UserBundle\Entity\IDeck $idMainDeck
     *
     * @return Player
     */
    public function setIdMainDeck(\Mirage\UserBundle\Entity\IDeck $idMainDeck = null)
    {
        $this->idMainDeck = $idMainDeck;

        return $this;
    }

    /**
     * Get idMainDeck
     *
     * @return \Mirage\UserBundle\Entity\IDeck
     */
    public function getIdMainDeck()
    {
        return $this->idMainDeck;
    }
}
