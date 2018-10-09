<?php

namespace Mirage\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mirage\MainBundle\Game\GameConfig;
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
    private $lv = 1;

    /**
     * @var integer
     *
     * @ORM\Column(name="exp", type="integer", nullable=true)
     */
    private $exp = 0;

    /**
     * @var integer
     */
    private $nextExp = 0;


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
     * @ORM\Column(name="powder", type="integer", nullable=true)
     */
    private $powder;


    /**
     * @var integer
     *
     * @ORM\Column(name="ap", type="integer", nullable=true)
     */
    private $ap = 30;

    /**
     * @var integer
     *
     * @ORM\Column(name="fp", type="integer", nullable=true)
     */
    private $fp = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="fpGive", type="integer", nullable=true)
     */
    private $fpGive = 0;


    /**
     * @var integer
     *
     * @ORM\Column(name="tp", type="integer", nullable=true)
     */
    private $tp = 0;

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
     * @ORM\Column(name="frontIArkPhase", type="integer", nullable=true)
     */
    private $frontIArkPhase;


    /**
     * @var integer
     *
     * @ORM\Column(name="midIArkPhase", type="integer", nullable=true)
     */
    private $midIArkPhase;

    /**
     * @var integer
     *
     * @ORM\Column(name="backIArkPhase", type="integer", nullable=true)
     */
    private $backIArkPhase;


    /**
     * @var integer
     *
     * @ORM\Column(name="friendCountMax", type="integer", nullable=false)
     */
    private $friendCountMax;


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
     * @ORM\OneToOne(targetEntity="IDeck")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idMainDeck", referencedColumnName="id")
     * })
     */
    private $idMainDeck;

    
    /**
     * Player constructor.
     * @param int $now
     */
    public function __construct($now)
    {
        $this->lv = 1;
        $this->exp = 0;
        $this->nextExp = 100;
        $this->jewel = 10;
        $this->powder = 100;
        $this->gold = 1000;
        $this->ap = 20;
        $this->fp = 0;
        $this->fpGive = 0;
        $this->tp = 0;
        $this->idFavoredChara = null;
        $this-> friendCountMax = 10;
        $this->lastLogin = $now;
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

    public function setNextExp(){
        $this->nextExp = $this->exp +1500;
        return $this;
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
     * @return int
     */
    public function getPowder()
    {
        return $this->powder;
    }

    /**
     * @param int $powder
     */
    public function setPowder($powder)
    {
        $this->powder = $powder;
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
     * @return int
     */
    public function getFpGive()
    {
        return $this->fpGive;
    }

    /**
     * @param int $fpGive
     */
    public function setFpGive($fpGive)
    {
        $this->fpGive = $fpGive;
    }



    /**
     * @return int
     */
    public function getTp()
    {
        return $this->tp;
    }

    /**
     * @param int $tp
     */
    public function setTp($tp)
    {
        $this->tp = $tp;
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
     * @return int
     */
    public function getFrontIArkPhase()
    {
        return $this->frontIArkPhase;
    }

    /**
     * @param int $frontIArkPhase
     */
    public function setFrontIArkPhase($frontIArkPhase)
    {
        $this->frontIArkPhase = $frontIArkPhase;
    }

    /**
     * @return int
     */
    public function getMidIArkPhase()
    {
        return $this->midIArkPhase;
    }

    /**
     * @param int $midIArkPhase
     */
    public function setMidIArkPhase($midIArkPhase)
    {
        $this->midIArkPhase = $midIArkPhase;
    }

    /**
     * @return int
     */
    public function getBackIArkPhase()
    {
        return $this->backIArkPhase;
    }

    /**
     * @param int $backIArkPhase
     */
    public function setBackIArkPhase($backIArkPhase)
    {
        $this->backIArkPhase = $backIArkPhase;
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
     * @return int
     */
    public function getFriendCountMax()
    {
        return $this->friendCountMax;
    }

    /**
     * @param int $friendCountMax
     */
    public function setFriendCountMax($friendCountMax)
    {
        $this->friendCountMax = $friendCountMax;
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

    //-----------------------------------------//
    public function giveRewardToPlayer($reward)
    {

        if($reward->getGold() > 0)
        {
            $this->addMoney(GameConfig::CARGO_GOLD,$reward->getGold());
        }
        if($reward->getJewel() > 0)
        {
            $this->addMoney(GameConfig::CARGO_LAPIS,$reward->getJewel());
        }
        if($reward->getExp() > 0)
        {
            $this->setExp($this->exp + $reward->getExp());
        }

        return $this;
    }

    public function unsetForRequest(){
        unset($this->created);
        unset($this->updated);
        unset($this->isEnabled);
        unset($this->isEnabled);
        unset($this->idMainDeck);
    }

    public function unsetMainDeck(){
        unset($this->idMainDeck);
    }
    /*
     * $wealth : 재화량, 음수가 들어오면 깎임.
     * $type : 재화의 종류, REWARD_GOLD 이면 골드, REWARD_LAPIS이면 청금석, REWARD_FRIEND_POINT면 우정포인트(fp)
     */
    public function addMoney($type, $wealth)
    {
        //TODO: 가챠에서 쓰이는 재화들 전부 구현할것. 가루,시약,티켓등
        $isError = true;
        switch ($type) {
            case GameConfig::CARGO_GOLD :
                if ($this->gold + $wealth > 0 || $this->gold + $wealth == 0) {
                    $this->gold += $wealth;
                    $isError = false;
                }
                break;
            case GameConfig::CARGO_LAPIS:
                if ($this->jewel + $wealth > 0 || $this->jewel + $wealth == 0) {
                    $this->jewel += $wealth;
                    $isError = false;
                }
                break;
            case GameConfig::CARGO_POWDER:
                if ($this->powder + $wealth > 0 || $this->powder + $wealth == 0) {
                    $this->powder += $wealth;
                    $isError = false;
                }
                break;
            case GameConfig::CARGO_FRIEND_POINT:
                if ($this->fp + $wealth > 0 || $this->fp + $wealth == 0) {
                    $this->fp += $wealth;
                    $isError = false;
                }
                break;

        }


        return !$isError ? $this : $isError;
    }

    public function addTp($tp){
        $this->tp += $tp;
        return $this;
    }

    public function addAp($ap){
        $this->ap += $ap;
        if($this->ap > $this->lv + 30) $this->ap = $this->lv + 30;
        if($this->ap < 0) $this->ap = 0;

    }


}
