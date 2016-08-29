<?php
/**
 * Created by PhpStorm.
 * User: JF_WS00
 * Date: 2016-08-17
 * Time: 오후 6:37
 */

namespace Mirage\MainBundle\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\Common\Collections\ArrayCollection;
use Mirage\AdminBundle\Controller\GameConfig;

/**
 * @MongoDB\Document
 */
class Skill
{

    public function __construct()
    {
        $this->effect = new ArrayCollection();
        $this->volume = new ArrayCollection();
    }

    /**
     * @MongoDB\Id(name="_id")
     */
    protected $id;

    /**
     * @MongoDB\Int
     */
    protected $skillId;

    /**
     * @MongoDB\String
     */
    protected $name_kr;

    /**
     * @MongoDB\String
     */
    protected $name_jp;

    /**
     * @MongoDB\Int
     */
    protected $type;

    /**
     * @MongoDB\Int
     */
    protected $duration;

    /**
     * @MongoDB\Int
     */
    protected $area;

    /**
     * @MongoDB\Int
     */
    protected $target;

    /**
     * @MongoDB\String
     */
    protected $description;

    /**
     * @MongoDB\Collection
     */
    protected $effect = array();

    /**
     * @MongoDB\Collection
     */
    protected $volume = array();


    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set skillId
     *
     * @param int $skillId
     * @return self
     */
    public function setSkillId($skillId)
    {
        $this->skillId = $skillId;
        return $this;
    }

    /**
     * Get skillId
     *
     * @return int $skillId
     */
    public function getSkillId()
    {
        return $this->skillId;
    }

    /**
     * Set nameKr
     *
     * @param string $nameKr
     * @return self
     */
    public function setNameKr($nameKr)
    {
        $this->name_kr = $nameKr;
        return $this;
    }

    /**
     * Get nameKr
     *
     * @return string $nameKr
     */
    public function getNameKr()
    {
        return $this->name_kr;
    }

    /**
     * Set nameJp
     *
     * @param string $nameJp
     * @return self
     */
    public function setNameJp($nameJp)
    {
        $this->name_jp = $nameJp;
        return $this;
    }

    /**
     * Get nameJp
     *
     * @return string $nameJp
     */
    public function getNameJp()
    {
        return $this->name_jp;
    }

    /**
     * Set type
     *
     * @param int $type
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get type
     *
     * @return int $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set duration
     *
     * @param int $duration
     * @return self
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
        return $this;
    }

    /**
     * Get duration
     *
     * @return int $duration
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set area
     *
     * @param int $area
     * @return self
     */
    public function setArea($area)
    {
        $this->area = $area;
        return $this;
    }

    /**
     * Get area
     *
     * @return int $area
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Set target
     *
     * @param int $target
     * @return self
     */
    public function setTarget($target)
    {
        $this->target = $target;
        return $this;
    }

    /**
     * Get target
     *
     * @return int $target
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set effect
     *
     * @param collection $effect
     * @return self
     */
    public function setEffect($effect)
    {
        $this->effect = $effect;
        return $this;
    }

    /**
     * Get effect
     *
     * @return collection $effect
     */
    public function getEffect()
    {
        return $this->effect;
    }

    /**
     * Set volume
     *
     * @param collection $volume
     * @return self
     */
    public function setVolume($volume)
    {
        $this->volume = $volume;
        return $this;
    }

    /**
     * Get volume
     *
     * @return collection $volume
     */
    public function getVolume()
    {
        return $this->volume;
    }

    public function deleteId()
    {
        unset($this->id);

        return $this;
    }
}
