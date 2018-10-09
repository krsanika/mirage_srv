<?php

namespace Mirage\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mirage\MainBundle\Game\GameConfig;

/**
 * Temporis
 *
 * @ORM\Table(name="Temporis")
 * @ORM\Entity(repositoryClass="Mirage\UserBundle\Repository\TemporisRepository")
 */
class Temporis
{
    public function __construct()
    {
        $this->created = time();
        $this->updated = time();
        $this->isEnabled = true;
    }

    /**
     * @var int
     *
     * @ORM\Column(name="idPlayer", type="integer", unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idPlayer;

    /**
     * @var int
     *
     * @ORM\Column(name="inTime", type="integer", nullable=true)
     */
    private $inTime;

    /**
     * @var int
     *
     * @ORM\Column(name="outTime", type="integer", nullable=true)
     */
    private $outTime;

    /**
     * @var int
     *
     * @ORM\Column(name="idHour", type="integer", nullable=true)
     */
    private $idHour;

    /**
     * @var int
     *
     * @ORM\Column(name="idMinute", type="integer", nullable=true)
     */
    private $idMinute;

    /**
     * @var int
     *
     * @ORM\Column(name="idCrown", type="integer", nullable=true)
     */
    private $idCrown;

    /**
     * @var int
     *
     * @ORM\Column(name="idCase", type="integer", nullable=true)
     */
    private $idCase;

    /**
     * @var int
     *
     * @ORM\Column(name="idChain", type="integer", nullable=true)
     */
    private $idChain;

    /**
     * @var int
     *
     * @ORM\Column(name="idPlate", type="integer", nullable=true)
     */
    private $idPlate;

    /**
     * @var int
     *
     * @ORM\Column(name="created", type="integer", nullable=true)
     */
    private $created;

    /**
     * @var int
     *
     * @ORM\Column(name="updated", type="integer", nullable=true)
     */
    private $updated;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isEnabled", type="boolean", nullable=false)
     */
    private $isEnabled = true;



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
     * @return Temporis
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
     * Set inTime
     *
     * @param integer $inTime
     *
     * @return Temporis
     */
    public function setInTime($inTime)
    {
        $this->inTime = $inTime;
    
        return $this;
    }

    /**
     * Get inTime
     *
     * @return integer
     */
    public function getInTime()
    {
        return $this->inTime;
    }

    /**
     * Set outTime
     *
     * @param integer $outTime
     *
     * @return Temporis
     */
    public function setOutTime($outTime)
    {
        $this->outTime = $outTime;
    
        return $this;
    }

    /**
     * Get outTime
     *
     * @return integer
     */
    public function getOutTime()
    {
        return $this->outTime;
    }

    //시간계산 해서 템포리스 저축. 마지막 lastLogin으로부터 10분 이후면 로그아웃으로 침
    //계산시간이 이상하여 음수가 왔을 때, 0이하라서 오히려 수가 빠질때 등 어뷰징에 대한 고려 없음
    public function addTime($lastLogin, $nowTime){
        if($lastLogin + 600 > $nowTime){
            $this->inTime += floor(($nowTime - $lastLogin) / GameConfig::LOGIN_TEMPORIS_RATE);
            if($this->inTime > 100000000) $this->inTime = 100000000;
        }else{
            $this->outTime += ($nowTime - $lastLogin);
            if($this->outTime > 100000000) $this->outTime = 100000000;
        }
        return $this;
    }

    /**
     * Set idHour
     *
     * @param integer $idHour
     *
     * @return Temporis
     */
    public function setIdHour($idHour)
    {
        $this->idHour = $idHour;
    
        return $this;
    }

    /**
     * Get idHour
     *
     * @return integer
     */
    public function getIdHour()
    {
        return $this->idHour;
    }

    /**
     * Set idMinute
     *
     * @param integer $idMinute
     *
     * @return Temporis
     */
    public function setIdMinute($idMinute)
    {
        $this->idMinute = $idMinute;
    
        return $this;
    }

    /**
     * Get idMinute
     *
     * @return integer
     */
    public function getIdMinute()
    {
        return $this->idMinute;
    }

    /**
     * Set idCrown
     *
     * @param integer $idCrown
     *
     * @return Temporis
     */
    public function setIdCrown($idCrown)
    {
        $this->idCrown = $idCrown;
    
        return $this;
    }

    /**
     * Get idCrown
     *
     * @return integer
     */
    public function getIdCrown()
    {
        return $this->idCrown;
    }

    /**
     * Set idCase
     *
     * @param integer $idCase
     *
     * @return Temporis
     */
    public function setIdCase($idCase)
    {
        $this->idCase = $idCase;
    
        return $this;
    }

    /**
     * Get idCase
     *
     * @return integer
     */
    public function getIdCase()
    {
        return $this->idCase;
    }

    /**
     * Set idChain
     *
     * @param integer $idChain
     *
     * @return Temporis
     */
    public function setIdChain($idChain)
    {
        $this->idChain = $idChain;
    
        return $this;
    }

    /**
     * Get idChain
     *
     * @return integer
     */
    public function getIdChain()
    {
        return $this->idChain;
    }

    /**
     * Set idPlate
     *
     * @param integer $idPlate
     *
     * @return Temporis
     */
    public function setIdPlate($idPlate)
    {
        $this->idPlate = $idPlate;
    
        return $this;
    }

    /**
     * Get idPlate
     *
     * @return integer
     */
    public function getIdPlate()
    {
        return $this->idPlate;
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
    public function isIsEnabled()
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

    public function subtractOutTime($time){
        $this->outTime -= $time;
        return $this;
    }

    public function subtractInTime($time){
        $this->inTime -= $time;
        return $this;
    }



}

