<?php

namespace Mirage\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Type as JMSType;

/**
 * IEncounter
 *
 * @ORM\Table(name="IEncounter")
 * @ORM\Entity
 */
class IEncounter
{
    public function __construct($idPlayer, $encounter, $now)
    {
        $this->idPlayer = $idPlayer;
        $this->progress =0;
        $this->leftEnemy = $encounter->getEnemyCount();
        $this->spEnemy = 0;
        $this->spPlayer = 0;
        $this->turn = 1;
        $this->created = $now;
        $this->updated = $now;
        $this->isEnabled = true;
        $this->pawns = new ArrayCollection();
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
     * @ORM\Column(name="idPlayer", type="integer", nullable=false)
     */
    private $idPlayer;

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
    private $turn = '1';

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
    private $isEnabled;



    /**
     * @var ArrayCollection
     * @JMSType("Mirage\UserBundle\Entity\IEncounterPawn")
     * @ORM\OneToMany(targetEntity="IEncounterPawn", mappedBy="idIEncounter")
     */
    private $pawns = array();

    /**
     * @JMSType("Mirage\MainBundle\Document\Encounter")
     */
    private $encounter;


    private $token;

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



    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getPawns()
    {
        return $this->pawns;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $pawns
     */
    public function setPawns($pawns)
    {
        $this->pawns = $pawns;
    }


    /**
     * @param \IEncounterPawn $pawn
     */
    public function addPawn($pawn){
        if($this->pawns->contains($pawn)){
            $this->pawns->add($pawn);
        }

    }

    /**
     * @return IEncounterPawn
     */
    public function removePawn($pawn){
        $this->pawns->removeElement($pawn);
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getEncounter()
    {
        return $this->encounter;
    }

    /**
     * @param ArrayCollection $encounter
     */
    public function setEncounter($encounter)
    {
        $this->encounter = $encounter;
    }

    /**
     * @return null
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param null $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }




//----------CUSTOM

    public function unsetForBattle($token){
        unset($this->idEncounter);
        foreach($this->pawns as &$pawn){
            $pawn->unsetForBattle();
        }
        unset($this->turn);
        unset($this->progress);
        unset($this->leftEnemy);
        unset($this->created);
        unset($this->updated);
        unset($this->idPlayer);
        unset($this->isEnabled);
        $this->encounter->fieldsForBattle();
        $this->token = $token;
        return $this;
    }

}
