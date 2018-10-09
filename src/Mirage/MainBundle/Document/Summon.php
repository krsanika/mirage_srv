<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-09-07
 * Time: 오전 3:08
 */

namespace Mirage\MainBundle\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\Type;

/**
 * @MongoDB\Document(repositoryClass="Mirage\MainBundle\Repository\SummonRepository")
 */
class Summon
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Int
     */
    protected $idSummon;

    /**
     * @MongoDB\Int
     */
    protected $idOrigin;
    /**
     * @MongoDB\Int
     */
    protected $targetType;

    /**
     * @MongoDB\EmbedMany(targetDocument="Mirage\MainBundle\Document\SummonMode")
     * @Type("ArrayCollection<Mirage\MainBundle\Document\SummonMode>")
     */
    protected $summonModes =array();

    /**
     * @MongoDB\EmbedMany(targetDocument="Mirage\MainBundle\Document\SummonTable")
     * @Type("ArrayCollection<Mirage\MainBundle\Document\summonTable>")
     */
    protected $summonTables =array();

    public function __construct()
    {
        $this->summonModes = new ArrayCollection();
        $this->summonTables = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIdSummon()
    {
        return $this->idSummon;
    }

    /**
     * @param mixed $summonId
     */
    public function setIdSummon($idSummon)
    {
        $this->idSummon = $idSummon;
    }

    /**
     * @return mixed
     */
    public function getIdOrigin()
    {
        return $this->idOrigin;
    }

    /**
     * @param mixed $idOrigin
     */
    public function setIdOrigin($idOrigin)
    {
        $this->idOrigin = $idOrigin;
    }



    /**
     * @return mixed
     */
    public function getTargetType()
    {
        return $this->targetType;
    }

    /**
     * @param mixed $targetType
     */
    public function setTargetType($targetType)
    {
        $this->targetType = $targetType;
    }

    /**
     * @return mixed
     */
    public function getSummonModes()
    {
        return $this->summonModes;
    }

    /**
     * @param ArrayCollection $summonModes
     */
    public function setSummonModes($summonModes)
    {
        $this->summonModes = $summonModes;
    }

    /**
     * @return mixed
     */
    public function getSummonTables()
    {
        return $this->summonTables;
    }

    /**
     * @param ArrayCollection $summonTables
     */
    public function setSummonTables($summonTables)
    {
        $this->summonTables = $summonTables;
    }


    /**
     * Add mode
     *
     * @param Mirage\MainBundle\Document\SummonMode $mode
     */
    public function addMode(\Mirage\MainBundle\Document\SummonMode $mode)
    {
        $this->summonModes[] = $mode;
    }

    /**
     * Remove chapter
     *
     * @param Mirage\MainBundle\Document\SummonMode $mode
     */
    public function removeMode(\Mirage\MainBundle\Document\SummonMode $mode)
    {
        $this->summonModes->removeElement($mode);
    }

    /**
     * Add table
     *
     * @param Mirage\MainBundle\Document\SummonTable $table
     */
    public function addTable(\Mirage\MainBundle\Document\SummonTable $table)
    {
        $this->summonTable[] = $table;
    }

    /**
     * Remove table
     *
     * @param Mirage\MainBundle\Document\SummonTable $table
     */
    public function removeTable(\Mirage\MainBundle\Document\SummonTable $table)
    {
        $this->summonTables->removeElement($table);
    }


// --------------------------


    public function getTableRandMax($minGrade){
        $max = 0;
        foreach($this->summonTables as $table){
            if($minGrade > $table->getGrade()) continue;
            $max += $table->getGravity();
        }
        return $max;
    }

    public function unsetId(){
        unset($this->id);
        return $this;
    }

    public function unsetTables(){
        unset($this->summonTables);
        return $this;
    }

    public function modesAtPossible($time){
        foreach($this->summonModes as $mode){
            if(!($mode->getStartDay() < $time && $mode->getEndDay() > $time)){
                $this->removeMode($mode);
            }
        }
        return $this;
    }

    public function getCurrentMode($idMode){
        if(empty($idMode)) return $this->summonModes->first();
        foreach($this->getSummonModes() as $sMode){
            if($idMode == $sMode->getIdMode()){
                $mode = $sMode;
                break;
            }
        }
        return $mode;
    }

    public function getTotalGravity(){
        $gravity = 0;
        foreach($this->summonTables as &$table){
            $gravity += $table->getGravity();
        }


        return $gravity;
    }

}