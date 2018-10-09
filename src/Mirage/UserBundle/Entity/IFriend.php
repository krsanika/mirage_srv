<?php

namespace Mirage\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IItem
 *
 * @ORM\Table(name="IFriend")
 * @ORM\Entity(repositoryClass="Mirage\UserBundle\Repository\IFriendRepository")*
 */

class IFriend
{
    public function __construct($idPlayer, $idFriend , $time) {
        $this->idPlayer = $idPlayer;
        $this->idFriend = $idFriend;
        $this->callCount = 0;
        $this->isAccepted = false;
        $this->created = $time;
        $this->updated = $time;
        $this->isEnabled = true;
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
     * @ORM\Column(name="idPlayer", type="integer", nullable=false)
     */
    private $idPlayer;

    /**
     * @var integer
     *
     * @ORM\Column(name="idFriend", type="integer", nullable=false)
     */
    private $idFriend;

    /**
     * @var integer
     *
     * @ORM\Column(name="callCount", type="integer", nullable=false)
     */
    private $callCount;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isAccepted", type="boolean", nullable=false)
     */
    private $isAccepted = false;


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
    private $isEnabled = true;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }



    /**
     * @return int
     */
    public function getIdPlayer()
    {
        return $this->idPlayer;
    }

    /**
     * @param int $idPlayer
     */
    public function setIdPlayer($idPlayer)
    {
        $this->idPlayer = $idPlayer;
    }

    /**
     * @return int
     */
    public function getIdFriend()
    {
        return $this->idFriend;
    }

    /**
     * @param int $idFriend
     */
    public function setIdFriend($idFriend)
    {
        $this->idFriend = $idFriend;
    }

    /**
     * @return int
     */
    public function getCallCount()
    {
        return $this->callCount;
    }

    /**
     * @param int $callCount
     */
    public function setCallCount($callCount)
    {
        $this->callCount = $callCount;
    }

    /**
     * @return boolean
     */
    public function isIsAccepted()
    {
        return $this->isAccepted;
    }

    /**
     * @param boolean $isAccepted
     */
    public function setIsAccepted($isAccepted)
    {
        $this->isAccepted = $isAccepted;
    }



    /**
     * @return int
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param int $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return int
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param int $updated
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }

    /**
     * @return boolean
     */
    public function isEnabled()
    {
        return $this->isEnabled;
    }

    /**
     * @param boolean $isEnabled
     */
    public function setIsEnabled($isEnabled)
    {
        $this->isEnabled = $isEnabled;
    }






    //==================================//

    public function unsetPlayer(){
        unset($this->idPlayer);
    }
}
