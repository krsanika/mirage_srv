<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-03-15
 * Time: 오전 3:57
 */

namespace Mirage\MainBundle\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Metadata\Tests\Driver\Fixture\A\A;
use Mirage\MainBundle\Document\StageInfo;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\Collection;
use JMS\Serializer\Annotation\Type as JMSType;
use Mirage\MainBundle\Document\Tile;
use Mirage\MainBundle\Document\EncounterTrigger;
/**
 * @MongoDB\Document
 */
class Encounter
{
    public function __construct()
    {
        $this->tiles = new ArrayCollection();
        $this->triggers = new ArrayCollection();
    }

    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Int
     */
    protected $idEnc;

    /**
     * @MongoDB\Int
     */
    protected $idBgNear;

    /**
     * @MongoDB\Int
     */
    protected $idBgMid;

    /**
     * @MongoDB\Int
     */
    protected $idBgFar;

    /**
     * @MongoDB\Int
     */
    protected $speedBgNear;

    /**
     * @MongoDB\Int
     */
    protected $speedBgMid;

    /**
     * @MongoDB\Int
     */
    protected $speedBgFar;

    /**
     * @MongoDB\Int
     */
    protected $idBgm;

    /**
     * @MongoDB\Int
     */
    protected $idTile;

    /**
     * @MongoDB\Int
     */
    protected $mapLength;

    /**
     * @JMSType("ArrayCollection<Mirage\MainBundle\Document\Tile>")
     * @MongoDB\EmbedMany(targetDocument="Mirage\MainBundle\Document\Tile")
     */
    protected $tiles = array();

    /**
     * @JMSType("ArrayCollection<Mirage\MainBundle\Document\EncounterTrigger>")
     * @MongoDB\EmbedMany(targetDocument="Mirage\MainBundle\Document\EncounterTrigger")
     */
    protected $triggers = array();

    /**
     * @MongoDB\Int
     */
    protected $startDay;

    /**
     * @MongoDB\Int
     */
    protected $endDay;

    /**
     * @MongoDB\Bool
     */
    protected $isEnabled;


    protected $enemyCount;

    protected $rewardStr;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @param mixed $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Int
     */
    public function getIdEnc()
    {
        return $this->idEnc;
    }

    /**
     * @param Int $idEnc
     * @return $this
     */
    public function setIdEnc($idEnc)
    {
        $this->idEnc = $idEnc;
        return $this;
    }



    /**
     * @return mixed
     */
    public function getIdBgm()
    {
        return $this->idBgm;
    }

    /**
     * @param mixed $idBgm
     */
    public function setIdBgm($idBgm)
    {
        $this->idBgm = $idBgm;
    }

    /**
     * @return mixed
     */
    public function getMapLength()
    {
        return $this->mapLength;
    }

    /**
     * @param mixed $mapLength
     */
    public function setMapLength($mapLength)
    {
        $this->mapLength = $mapLength;
    }


    /**
     * @return mixed
     */
    public function getIdTile()
    {
        return $this->idTile;
    }

    /**
     * @param mixed $idTile
     */
    public function setIdTile($idTile)
    {
        $this->idTile = $idTile;
    }

    /**
     * @return mixed
     */
    public function getTiles()
    {
        return $this->tiles;
    }

    /**
     * @param mixed $tiles
     */
    public function setTiles($tiles)
    {
        $this->tiles = $tiles;
    }

    /**
     * Add Tile
     *
     * @param \Mirage\MainBundle\Document\Tile $tile
     */
    public function addTile(\Mirage\MainBundle\Document\Tile $tile)
    {
        $this->tiles->add($tile);
    }

    /**
     * Remove Tile
     *
     * @param \Mirage\MainBundle\Document\Tile $tile
     */
    public function removeTile(\Mirage\MainBundle\Document\Tile $tile)
    {
        $this->tiles->removeElement($tile);
    }


    public function getEnemy($location = null){
        if(empty($location)){
            return $this->tiles->first();
        }
//        foreach($this->Tiles as $tile){
//            if($enemyPostion->getPosition() == $tile ){
//                return $enemyPostion->getEnemy();
//            }
//        }
    }

    public function addEnemy(Enemy $enemy){
        if($this->tiles->contains($enemy)){
            $this->tiles->add($enemy);
        }
        return $this;
    }

    public function removeEnemy($enemy){
        $this->tiles->removeElement($enemy);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTriggers()
    {
        return $this->triggers;
    }

    /**
     * @param mixed $triggers
     */
    public function setTriggers($triggers)
    {
        $this->triggers = $triggers;
    }

    public function addTriggers(EncounterTrigger $trigger)
    {
        return $this->triggers->add($trigger);
    }

    public function removeTriggers(EncounterTrigger $trigger)
    {
        $this->triggers->removeElement($trigger);
        return $this;
    }


    /**
     * Set startDay
     *
     * @param Int $startDay
     * @return self
     */
    public function setStartDay($startDay)
    {
        $this->startDay = $startDay;
        return $this;
    }

    /**
     * Get startDay
     *
     * @return Int $startDay
     */
    public function getStartDay()
    {
        return $this->startDay;
    }

    /**
     * Set endDay
     *
     * @param Int $endDay
     * @return self
     */
    public function setEndDay($endDay)
    {
        $this->endDay = $endDay;
        return $this;
    }

    /**
     * Get endDay
     *
     * @return Int $endDay
     */
    public function getEndDay()
    {
        return $this->endDay;
    }

    /**
     * Set isEnabled
     *
     * @param Bool $isEnabled
     * @return self
     */
    public function setIsEnabled($isEnabled)
    {
        $this->isEnabled = $isEnabled;
        return $this;
    }

    /**
     * Get isEnabled
     *
     * @return Bool $isEnabled
     */
    public function getIsEnabled()
    {
        return $this->isEnabled;
    }

    /**
     * Set reward
     *
     * @param \Mirage\MainBundle\Document\Reward $reward
     * @return self
     */
    public function setReward(Reward $reward)
    {
        $this->reward = $reward;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdBgNear()
    {
        return $this->idBgNear;
    }

    /**
     * @param mixed $idBgNear
     */
    public function setIdBgNear($idBgNear)
    {
        $this->idBgNear = $idBgNear;
    }

    /**
     * @return mixed
     */
    public function getIdBgMid()
    {
        return $this->idBgMid;
    }

    /**
     * @param mixed $idBgMid
     */
    public function setIdBgMid($idBgMid)
    {
        $this->idBgMid = $idBgMid;
    }

    /**
     * @return mixed
     */
    public function getIdBgFar()
    {
        return $this->idBgFar;
    }

    /**
     * @param mixed $idBgFar
     */
    public function setIdBgFar($idBgFar)
    {
        $this->idBgFar = $idBgFar;
    }

    /**
     * @return mixed
     */
    public function getSpeedBgNear()
    {
        return $this->speedBgNear;
    }

    /**
     * @param mixed $speedBgNear
     */
    public function setSpeedBgNear($speedBgNear)
    {
        $this->speedBgNear = $speedBgNear;
    }

    /**
     * @return mixed
     */
    public function getSpeedBgMid()
    {
        return $this->speedBgMid;
    }

    /**
     * @param mixed $speedBgMid
     */
    public function setSpeedBgMid($speedBgMid)
    {
        $this->speedBgMid = $speedBgMid;
    }

    /**
     * @return mixed
     */
    public function getSpeedBgFar()
    {
        return $this->speedBgFar;
    }

    /**
     * @param mixed $SpeedBgFar
     */
    public function setSpeedBgFar($speedBgFar)
    {
        $this->speedBgFar = $speedBgFar;
    }


    /**
     * Get reward
     *
     * @return \Mirage\MainBundle\Document\Reward $reward
     */
    public function getReward()
    {
        return $this->reward;
    }

    public function deleteId()
    {
        unset($this->id);
        foreach($this->tiles as $tile){
            $tile->deleteId();
        }
       // $this->reward->deleteId();
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEnemyCount()
    {
        $count = 0;
        foreach($this->tiles as $tile){
            if(!empty($tile->getEnemy()))
            {
                $count += 1;
            }
        }

        return $count;
    }

    public function getEnemyIds(){
        $ids = [];
        foreach($this->tiles as $tile){
            if(!empty($tile->getEnemy()))
            {
                if(array_key_exists('enemyId'.$tile->getEnemy()->getIdEnemy() ,$ids)){
                    $ids['enemyId'.$tile->getEnemy()->getIdEnemy()] ++;
                }else $ids['enemyId'.$tile->getEnemy()->getIdEnemy()] = 1;
            }
        }

        return $ids;
    }

    /**
     * @param mixed $enemyCount
     * @return $this
     */
    public function setEnemyCount($enemyCount)
    {
        $this->enemyCount = $enemyCount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRewardStr()
    {
        return $this->rewardStr;
    }




    public function unsetForStoryView(){
        unset($this->id);
        unset($this->idEnc);
        unset($this->startDay);
        unset($this->endDay);
        unset($this->isEnabled);
        unset($this->tiles);
        unset($this->triggers);
      //  $this->reward->remakeForStoryView();
        return $this;
    }

    public function fieldsForBattle(){
//        $this->setRewardStr($this->reward);
        unset($this->reward);
        unset($this->id);
        unset($this->startDay);
        unset($this->endDay);
        unset($this->isEnabled);

        foreach($this->tiles as &$tile){
            $tile->unsetEnemy();
            if(empty($tile->getTerrain())){
                $tile->unsetLocation();
                $this->tiles->removeElement($tile);
            }
        }
//        $this->tiles->clear();

        return $this;
    }

}
