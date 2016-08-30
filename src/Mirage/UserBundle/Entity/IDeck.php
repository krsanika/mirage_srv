<?php

namespace Mirage\UserBundle\Entity;

use \Mirage\UserBundle\Entity\IArk;
use \Mirage\UserBundle\Entity\Player;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * IDeck
 *
 * @ORM\Table(name="IDeck", indexes={@ORM\Index(name="FK_IDeck_Player", columns={"idPlayer"}), @ORM\Index(name="FK_IDeck_IArk_1", columns={"a1"}), @ORM\Index(name="FK_IDeck_IArk", columns={"a0"}), @ORM\Index(name="FK_IDeck_IArk_2", columns={"a2"}), @ORM\Index(name="FK_IDeck_IArk_4", columns={"b0"}), @ORM\Index(name="FK_IDeck_IArk_5", columns={"b1"}), @ORM\Index(name="FK_IDeck_IArk_6", columns={"b2"}), @ORM\Index(name="FK_IDeck_IArk_7", columns={"c0"}), @ORM\Index(name="FK_IDeck_IArk_8", columns={"c1"}), @ORM\Index(name="FK_IDeck_IArk_9", columns={"c2"})})
 * @ORM\Entity(repositoryClass="Mirage\UserBundle\Repository\IDeckRepository")
 */
class IDeck
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
     * @ORM\Column(name="deckNumber", type="tinyint", nullable=true)
     */
    private $deckNumber;

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
     *   @ORM\JoinColumn(name="a0", referencedColumnName="id")
     * })
     */
    private $a0;

    /**
     * @var \IArk
     *
     * @ORM\ManyToOne(targetEntity="IArk")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="a1", referencedColumnName="id")
     * })
     */
    private $a1;

    /**
     * @var \IArk
     *
     * @ORM\ManyToOne(targetEntity="IArk")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="a2", referencedColumnName="id")
     * })
     */
    private $a2;

    /**
     * @var \IArk
     *
     * @ORM\ManyToOne(targetEntity="IArk")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="b0", referencedColumnName="id")
     * })
     */
    private $b0;

    /**
     * @var \IArk
     *
     * @ORM\ManyToOne(targetEntity="IArk")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="b1", referencedColumnName="id")
     * })
     */
    private $b1;

    /**
     * @var \IArk
     *
     * @ORM\ManyToOne(targetEntity="IArk")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="b2", referencedColumnName="id")
     * })
     */
    private $b2;

    /**
     * @var \IArk
     *
     * @ORM\ManyToOne(targetEntity="IArk")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="c0", referencedColumnName="id")
     * })
     */
    private $c0;

    /**
     * @var \IArk
     *
     * @ORM\ManyToOne(targetEntity="IArk")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="c1", referencedColumnName="id")
     * })
     */
    private $c1;

    /**
     * @var \IArk
     *
     * @ORM\ManyToOne(targetEntity="IArk")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="c2", referencedColumnName="id")
     * })
     */
    private $c2;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set deckNumber
     *
     * @param tinyint $deckNumber
     *
     * @return IDeck
     */
    public function setDeckNumber($deckNumber)
    {
        $this->deckNumber = $deckNumber;

        return $this;
    }

    /**
     * Get deckNumber
     *
     * @return tinyint
     */
    public function getDeckNumber()
    {
        return $this->deckNumber;
    }

    /**
     * Set created
     *
     * @param integer $created
     *
     * @return IDeck
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
     * @return IDeck
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
     * @return IDeck
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
     * Set a0
     *
     * @param IArk$a0
     *
     * @return IDeck
     */
    public function setA0(IArk $a0 = null)
    {
        $this->a0 = $a0;

        return $this;
    }

    /**
     * Get a0
     *
     * @return \Mirage\UserBundle\Entity\IArk
     */
    public function getA0()
    {
        return $this->a0;
    }

    /**
     * Set a1
     *
     * @param IArk$a1
     *
     * @return IDeck
     */
    public function setA1(IArk $a1 = null)
    {
        $this->a1 = $a1;

        return $this;
    }

    /**
     * Get a1
     *
     * @return \Mirage\UserBundle\Entity\IArk
     */
    public function getA1()
    {
        return $this->a1;
    }

    /**
     * Set a2
     *
     * @param IArk$a2
     *
     * @return IDeck
     */
    public function setA2(IArk $a2 = null)
    {
        $this->a2 = $a2;

        return $this;
    }

    /**
     * Get a2
     *
     * @return \Mirage\UserBundle\Entity\IArk
     */
    public function getA2()
    {
        return $this->a2;
    }

    /**
     * Set b0
     *
     * @param IArk$b0
     *
     * @return IDeck
     */
    public function setB0(IArk $b0 = null)
    {
        $this->b0 = $b0;

        return $this;
    }

    /**
     * Get b0
     *
     * @return \Mirage\UserBundle\Entity\IArk
     */
    public function getB0()
    {
        return $this->b0;
    }

    /**
     * Set b1
     *
     * @param IArk$b1
     *
     * @return IDeck
     */
    public function setB1(IArk $b1 = null)
    {
        $this->b1 = $b1;

        return $this;
    }

    /**
     * Get b1
     *
     * @return \Mirage\UserBundle\Entity\IArk
     */
    public function getB1()
    {
        return $this->b1;
    }

    /**
     * Set b2
     *
     * @param IArk$b2
     *
     * @return IDeck
     */
    public function setB2(IArk $b2 = null)
    {
        $this->b2 = $b2;

        return $this;
    }

    /**
     * Get b2
     *
     * @return \Mirage\UserBundle\Entity\IArk
     */
    public function getB2()
    {
        return $this->b2;
    }

    /**
     * Set c0
     *
     * @param IArk$c0
     *
     * @return IDeck
     */
    public function setC0(IArk $c0 = null)
    {
        $this->c0 = $c0;

        return $this;
    }

    /**
     * Get c0
     *
     * @return \Mirage\UserBundle\Entity\IArk
     */
    public function getC0()
    {
        return $this->c0;
    }

    /**
     * Set c1
     *
     * @param IArk$c1
     *
     * @return IDeck
     */
    public function setC1(IArk $c1 = null)
    {
        $this->c1 = $c1;

        return $this;
    }

    /**
     * Get c1
     *
     * @return \Mirage\UserBundle\Entity\IArk
     */
    public function getC1()
    {
        return $this->c1;
    }

    /**
     * Set c2
     *
     * @param IArk$c2
     *
     * @return IDeck
     */
    public function setC2(IArk $c2 = null)
    {
        $this->c2 = $c2;

        return $this;
    }

    /**
     * Get c2
     *
     * @return \Mirage\UserBundle\Entity\IArk
     */
    public function getC2()
    {
        return $this->c2;
    }

    /**
     * Set idPlayer
     *
     * @param \Mirage\UserBundle\Entity\Player $idPlayer
     *
     * @return IDeck
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

    public function getArkPos(){
        return array(
            "a0"=>$this->getA0(),
            "a1"=>$this->getA1(),
            "a2"=>$this->getA2(),
            "b0"=>$this->getB0(),
            "b1"=>$this->getB1(),
            "b2"=>$this->getB2(),
            "c0"=>$this->getC0(),
            "c1"=>$this->getC1(),
            "c2"=>$this->getC2()
        );
    }

    public function unsetPlayer()
    {
        unset($this->idPlayer);
        return $this;
    }

    public function useBattle()
    {
        unset($this->id);
        unset($this->deckNumber);
        unset($this->idPlayer);
        unset($this->created);
        unset($this->updated);
        unset($this->isEnabled);
        $this->useBattleDeckArk();
        return $this;
    }

    public function useBattleDeckArk()
    {
        foreach($this->getArkPos() as $ark){
            if(isset($ark)){
                $ark->useBattle();
            }
        }
    }

}
