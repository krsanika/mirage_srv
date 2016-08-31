<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-03-15
 * Time: 오전 3:57
 */

namespace Mirage\MainBundle\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Mirage\MainBundle\Document\StageInfo;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\Collection;
use JMS\Serializer\Annotation\Type as JMSType;
/**
 * @MongoDB\Document
 */
class Encounter
{
    public function __construct()
    {
        $this->enemyPositions = new ArrayCollection();
    }

    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Int
     */
    protected $encId;

    /**
     * @JMSType("Mirage\MainBundle\Document\StageInfo")
     * @MongoDB\EmbedOne(targetDocument="Mirage\MainBundle\Document\StageInfo")
     */
    protected $stageInfo;

    /**
     * @JMSType("ArrayCollection<Mirage\MainBundle\Document\EnemyPosition>")
     * @MongoDB\EmbedMany(targetDocument="Mirage\MainBundle\Document\EnemyPosition")
     */
    protected $enemyPositions = array();

    /**
     * @MongoDB\Field(name="eventTrigger", type="hash")
     */
    protected $eventTrigger = array();

    /**
     * @JMSType("Mirage\MainBundle\Document\Reward")
     * @MongoDB\ReferenceOne(targetDocument="Mirage\MainBundle\Document\Reward")
     */
    protected $reward;

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
    public function getEncId()
    {
        return $this->encId;
    }

    /**
     * @param Int $encId
     * @return $this
     */
    public function setEncId($encId)
    {
        $this->encId = $encId;
        return $this;
    }


    /**
     * @param array $stageInfo
     * @return $this
     */
    public function setStageInfo()
    {
        $this->stageInfo;
        return $this;
    }

    /**
     * @return array
     */
    public function getStageInfo()
    {
        return $this->stageInfo;
    }

    /**
     * Add stageInfo
     *
     * @param StageInfo $stageInfo
     * @return self
     */
    public function addStageInfo(StageInfo $stageInfo)
    {
        $this->stageInfo[] = $stageInfo;
    }


    /**
     * Remove stageInfo
     *
     * @param StageInfo $stageInfo
     * @return self
     */
    public function removeStageInfo(StageInfo $stageInfo)
    {
        $this->stageInfo->removeElement($stageInfo);
    }



    /**
     * Add enemyPosition
     *
     * @param Mirage\MainBundle\Document\EnemyPosition $enemyPosition
     */
    public function addEnemyPosition(\Mirage\MainBundle\Document\EnemyPosition $enemyPosition)
    {
        $this->enemyPositions[] = $enemyPosition;
    }

    /**
     * Remove enemyPosition
     *
     * @param Mirage\MainBundle\Document\EnemyPosition $enemyPosition
     */
    public function removeEnemyPosition(\Mirage\MainBundle\Document\EnemyPosition $enemyPosition)
    {
        $this->enemyPositions->removeElement($enemyPosition);
    }

    /**
     * Get enemyPositions
     *
     * @return \Doctrine\Common\Collections\Collection $enemyPositions
     */
    public function getEnemyPositions()
    {
        return $this->enemyPositions;
    }

    public function getEnemy($tilePositions = null){
        if(empty($tilePositions)){
            return $this->enemyPositions->first();
        }
        foreach($this->enemyPositions as $enemyPostion){
            if($enemyPostion->getPosition() == $tilePositions ){
                return $enemyPostion->getEnemy();
            }
        }
    }

    public function addEnemy(Enemy $enemy){
        if($this->enemyPositions->contains($enemy)){
            $this->enemyPositions->add($enemy);
        }
        return $this;
    }

    public function removeEnemy($enemy){
        $this->enemyPositions->removeElement($enemy);
        return $this;
    }

    /**
     * Set eventTrigger
     *
     * @param hash $eventTrigger
     * @return self
     */
    public function setEventTrigger($eventTrigger)
    {
        $this->eventTrigger = $eventTrigger;
        return $this;
    }

    /**
     * Get eventTrigger
     *
     * @return hash $eventTrigger
     */
    public function getEventTrigger()
    {
        return $this->eventTrigger;
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
     * @param Mirage\MainBundle\Document\Reward $reward
     * @return self
     */
    public function setReward(\Mirage\MainBundle\Document\Reward $reward)
    {
        $this->reward = $reward;
        return $this;
    }

    /**
     * Get reward
     *
     * @return Mirage\MainBundle\Document\Reward $reward
     */
    public function getReward()
    {
        return $this->reward;
    }

    public function deleteId()
    {
        unset($this->id);
        foreach($this->enemyPositions as $enemyInfo){
            $enemyInfo->deleteId();
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEnemyCount()
    {
        return $this->enemyCount;
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


    public function remakeForStoryView(){
        unset($this->eventTrigger);
        unset($this->startDay);
        unset($this->endDay);
        unset($this->isEnabled);
        unset($this->id);
        unset($this->enemyPositions);
        return $this;
    }

}
