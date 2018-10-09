<?php

namespace Mirage\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserDevice
 *
 * @ORM\Table(name="UserDevice", indexes={@ORM\Index(name="FK_UserDevice_User", columns={"idUser"}), @ORM\Index(name="FK_UserDevice_Player", columns={"idPlayer"})})
 * @ORM\Entity
 */
class UserDevice
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
     * @ORM\Column(name="deviceName", type="string", length=255, nullable=false)
     */
    private $deviceName;

    /**
     * @var tinyint
     *
     * @ORM\Column(name="osType", type="tinyint", nullable=false)
     */
    private $osType;

    /**
     * @var string
     *
     * @ORM\Column(name="idDevice", type="string", length=255, nullable=true)
     */
    private $idDevice;

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
     * @var \Player
     *
     * @ORM\ManyToOne(targetEntity="Player")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idPlayer", referencedColumnName="id")
     * })
     */
    private $idPlayer;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUser", referencedColumnName="id")
     * })
     */
    private $idUser;



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
     * Set deviceName
     *
     * @param string $deviceName
     *
     * @return UserDevice
     */
    public function setDeviceName($deviceName)
    {
        $this->deviceName = $deviceName;

        return $this;
    }

    /**
     * Get deviceName
     *
     * @return string
     */
    public function getDeviceName()
    {
        return $this->deviceName;
    }

    /**
     * Set osType
     *
     * @param tinyint $osType
     *
     * @return UserDevice
     */
    public function setOsType($osType)
    {
        $this->osType = $osType;

        return $this;
    }

    /**
     * Get osType
     *
     * @return tinyint
     */
    public function getOsType()
    {
        return $this->osType;
    }

    /**
     * Set idDevice
     *
     * @param string $idDevice
     *
     * @return UserDevice
     */
    public function setIdDevice($idDevice)
    {
        $this->idDevice = $idDevice;

        return $this;
    }

    /**
     * Get idDevice
     *
     * @return string
     */
    public function getIdDevice()
    {
        return $this->idDevice;
    }

    /**
     * Set created
     *
     * @param integer $created
     *
     * @return UserDevice
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
     * @return UserDevice
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
     * @return UserDevice
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
     * Set idPlayer
     *
     * @param \Mirage\UserBundle\Entity\Player $idPlayer
     *
     * @return UserDevice
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

    /**
     * Set idUser
     *
     * @param \Mirage\UserBundle\Entity\User $idUser
     *
     * @return UserDevice
     */
    public function setIdUser(\Mirage\UserBundle\Entity\User $idUser = null)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return \Mirage\UserBundle\Entity\User
     */
    public function getIdUser()
    {
        return $this->idUser;
    }
}
