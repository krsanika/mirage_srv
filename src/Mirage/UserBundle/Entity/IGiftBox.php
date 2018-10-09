<?php

namespace Mirage\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IItem
 *
 * @ORM\Table(name="IGiftBox")
 */

class IGiftBox
{
    public function __construct($player, $idGift , $time) {
        $this->idGift = $idGift;
        $this->idPlayer = $player;
        $this->setCreated($time);
        $this->setUpdated($time);
        $this->isTaked = false;
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
     * @ORM\Column(name="idGift", type="integer", nullable=false)
     */
    private $idGift;

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
    private $isTaked = false;

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
     * @return int
     */
    public function getIdGift()
    {
        return $this->idGift;
    }

    /**
     * @param int $idGift
     */
    public function setIdGift($idGift)
    {
        $this->idGift = $idGift;
    }


    /**
     * Set created
     *
     * @param integer $created
     *
     * @return IItem
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
     * @return IItem
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
     * @param boolean $isTaked
     *
     * @return IItem
     */
    public function setIsTaked($isTaked)
    {
        $this->isTaked = $isTaked;

        return $this;
    }

    /**
     * Get isEnabled
     *
     * @return boolean
     */
    public function getIsTaked()
    {
        return $this->isTaked;
    }

    /**
     * Set idPlayer
     *
     * @param \Mirage\UserBundle\Entity\Player $idPlayer
     *
     * @return IItem
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


    //==================================//

    public function unsetPlayer(){
        unset($this->idPlayer);
    }
}
