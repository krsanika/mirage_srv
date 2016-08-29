<?php

namespace Mirage\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IEncounter
 *
 * @ORM\Table(name="IEncounter")
 * @ORM\Entity
 */
class IEncounter
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
     * @ORM\Column(name="idPlayer", type="integer", nullable=false)
     */
    private $idPlayer = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="idEncounter", type="integer", nullable=false)
     */
    private $idEncounter = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="leftEnemy", type="integer", nullable=false)
     */
    private $leftEnemy = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="progress", type="integer", nullable=false)
     */
    private $progress = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="spPlayer", type="integer", nullable=false)
     */
    private $spPlayer = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="spEnemy", type="integer", nullable=false)
     */
    private $spEnemy = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="turn", type="integer", nullable=false)
     */
    private $turn = '0';

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
     * Set idPlayer
     *
     * @param integer $idPlayer
     *
     * @return IEncounter
     */
    public function setIdPlayer($idPlayer)
    {
        $this->idPlayer = $idPlayer;

        return $this;
    }

    /**
     * Get idPlayer
     *
     * @return integer
     */
    public function getIdPlayer()
    {
        return $this->idPlayer;
    }

    /**
     * Set idEncounter
     *
     * @param integer $idEncounter
     *
     * @return IEncounter
     */
    public function setIdEncounter($idEncounter)
    {
        $this->idEncounter = $idEncounter;

        return $this;
    }

    /**
     * Get idEncounter
     *
     * @return integer
     */
    public function getIdEncounter()
    {
        return $this->idEncounter;
    }

    /**
     * Set leftEnemy
     *
     * @param integer $leftEnemy
     *
     * @return IEncounter
     */
    public function setLeftEnemy($leftEnemy)
    {
        $this->leftEnemy = $leftEnemy;

        return $this;
    }

    /**
     * Get leftEnemy
     *
     * @return integer
     */
    public function getLeftEnemy()
    {
        return $this->leftEnemy;
    }

    /**
     * Set progress
     *
     * @param integer $progress
     *
     * @return IEncounter
     */
    public function setProgress($progress)
    {
        $this->progress = $progress;

        return $this;
    }

    /**
     * Get progress
     *
     * @return integer
     */
    public function getProgress()
    {
        return $this->progress;
    }

    /**
     * Set spPlayer
     *
     * @param integer $spPlayer
     *
     * @return IEncounter
     */
    public function setSpPlayer($spPlayer)
    {
        $this->spPlayer = $spPlayer;

        return $this;
    }

    /**
     * Get spPlayer
     *
     * @return integer
     */
    public function getSpPlayer()
    {
        return $this->spPlayer;
    }

    /**
     * Set spEnemy
     *
     * @param integer $spEnemy
     *
     * @return IEncounter
     */
    public function setSpEnemy($spEnemy)
    {
        $this->spEnemy = $spEnemy;

        return $this;
    }

    /**
     * Get spEnemy
     *
     * @return integer
     */
    public function getSpEnemy()
    {
        return $this->spEnemy;
    }

    /**
     * Set turn
     *
     * @param integer $turn
     *
     * @return IEncounter
     */
    public function setTurn($turn)
    {
        $this->turn = $turn;

        return $this;
    }

    /**
     * Get turn
     *
     * @return integer
     */
    public function getTurn()
    {
        return $this->turn;
    }

    /**
     * Set created
     *
     * @param integer $created
     *
     * @return IEncounter
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
     * @return IEncounter
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
     * @return IEncounter
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
