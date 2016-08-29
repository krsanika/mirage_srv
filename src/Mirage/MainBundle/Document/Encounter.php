<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-03-15
 * Time: 오전 3:57
 */

namespace Mirage\MainBundle\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Mirage\MainBundle\Document\EnemyPos;
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
        $this->enemyPos = new ArrayCollection();
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
     * @JMSType("ArrayCollection<Mirage\MainBundle\Document\EnemyPos>")
     * @MongoDB\EmbedMany(targetDocument="Mirage\MainBundle\Document\EnemyPos")
     */
    protected $enemyPos = array();

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
     * @return mixed
     */
    public function getEnemyPos()
    {
        return $this->enemyPos;
    }

    public function getEnemy($tilePos = null){
        if(empty($tilePos)){
            return $this->enemyPos->first();
        }
        foreach($this->enemyPos as $enemyPo){
            if($enemyPo->getPosition() == $tilePos ){
                return $enemyPo->getEnemy();
            }
        }
    }

    public function addEnemy(Enemy $enemy){
        if($this->enemyPos->contains($enemy)){
            $this->enemyPos->add($enemy);
        }
        return $this;
    }

    public function removeEnemy($enemy){
        $this->enemyPos->removeElement($enemy);
        return $this;
    }

    /**
     * @param mixed $enemyPos
     */
    public function setEnemyPos($enemyPos)
    {
        $this->enemyPos = $enemyPos;
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
     * Add enemyPos
     *
     * @param EnemyPos $enemyPos
     * @return self
     */
    public function addEnemyPos(EnemyPos $enemyPos)
    {
        $this->enemyPos[] = $enemyPos;
    }


    /**
     * Remove enemyPos
     *
     * @param EnemyPos $enemyPos
     * @return self
     */
    public function removeEnemyPos(EnemyPos $enemyPos)
    {
        $this->enemyPos->removeElement($enemyPos);
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
        foreach($this->enemyPos as $enemyInfo){
            $enemyInfo->deleteId();
        }
        return $this;
    }



    /**
     * Add enemyPo
     *
     * @param Mirage\MainBundle\Document\EnemyPos $enemyPo
     */
    public function addEnemyPo(\Mirage\MainBundle\Document\EnemyPos $enemyPo)
    {
        $this->enemyPos[] = $enemyPo;
    }

    /**
     * Remove enemyPo
     *
     * @param Mirage\MainBundle\Document\EnemyPos $enemyPo
     */
    public function removeEnemyPo(\Mirage\MainBundle\Document\EnemyPos $enemyPo)
    {
        $this->enemyPos->removeElement($enemyPo);
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
        unset($this->enemyPos);
        return $this;
    }

    public function unsetEnemyPos(){

    }

}
