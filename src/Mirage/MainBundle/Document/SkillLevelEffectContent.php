<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-02-06
 * Time: 오후 9:24
 */

namespace Mirage\MainBundle\Document;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use JMS\Serializer\Annotation\Type as JMSType;

/**
 * @MongoDB\EmbeddedDocument
 */
class SkillLevelEffectContent
{
    /**
     * @MongoDB\String
     */
    protected $type;

    /**
     * @MongoDB\Int
     */
    protected $area;

    /**
     * @MongoDB\Int
     */
    protected $chance;


    /**
     * @MongoDB\Int
     */
    protected $volume;

    /**
     * @MongoDB\Int
     */
    protected $duration;

    /**
     * @MongoDB\Int
     */
    protected $delay;


    /**
     * @MongoDB\Int
     */
    protected $idCondition;

    /**
     * @MongoDB\Int
     */
    protected $idSubject;



    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getChance()
    {
        return $this->chance;
    }

    /**
     * @param mixed $chance
     */
    public function setChance($chance)
    {
        $this->chance = $chance;
    }



    /**
     * @return mixed
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * @param mixed $volume
     */
    public function setVolume($volume)
    {
        $this->volume = $volume;
    }

    /**
     * @return mixed
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param mixed $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    /**
     * @return mixed
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * @param mixed $area
     */
    public function setArea($area)
    {
        $this->area = $area;
    }

    /**
     * @return mixed
     */
    public function getDelay()
    {
        return $this->delay;
    }

    /**
     * @param mixed $delay
     */
    public function setDelay($delay)
    {
        $this->delay = $delay;
    }


    /**
     * @return mixed
     */
    public function getIdCondition()
    {
        return $this->idCondition;
    }

    /**
     * @param mixed $idCondition
     */
    public function setIdCondition($idCondition)
    {
        $this->idCondition = $idCondition;
    }

    /**
     * @return mixed
     */
    public function getIdSubject()
    {
        return $this->idSubject;
    }

    /**
     * @param mixed $idSubject
     */
    public function setIdSubject($idSubject)
    {
        $this->idSubject = $idSubject;
    }



}