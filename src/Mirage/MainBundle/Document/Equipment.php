<?php
/**
 * Created by PhpStorm.
 * User: JF_WS00
 * Date: 2016-08-17
 * Time: 오후 6:38
 */

namespace Mirage\MainBundle\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\Common\Collections\ArrayCollection;
use Mirage\AdminBundle\Controller\GameConfig;

/**
 * @MongoDB\Document
 */
class Equipment
{
    /**
     * @MongoDB\Id(name="_id")
     */
    protected $id;

    /**
     * @MongoDB\int
     */
    protected $equipmentId;

    /**
     * @MongoDB\Int
     */
    protected $itemId;

    /**
     * @MongoDB\String
     */
    protected $name_kr;

    /**
     * @MongoDB\String
     */
    protected $name_jp;

    /**
     * @MongoDB\String
     */
    protected $effect;

    /**
     * @MongoDB\Int
     */
    protected $volume;

    /**
     * @MongoDB\Int
     */
    protected $tier;

    /**
     * @MongoDB\String
     */
    protected $description;


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
     * Set equipmentId
     *
     * @param int $equipmentId
     * @return self
     */
    public function setEquipmentId($equipmentId)
    {
        $this->equipmentId = $equipmentId;
        return $this;
    }

    /**
     * Get equipmentId
     *
     * @return int $equipmentId
     */
    public function getEquipmentId()
    {
        return $this->equipmentId;
    }

    /**
     * Set itemId
     *
     * @param int $itemId
     * @return self
     */
    public function setItemId($itemId)
    {
        $this->itemId = $itemId;
        return $this;
    }

    /**
     * Get itemId
     *
     * @return int $itemId
     */
    public function getItemId()
    {
        return $this->itemId;
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
     * Set effect
     *
     * @param string $effect
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
     * @return string $effect
     */
    public function getEffect()
    {
        return $this->effect;
    }

    /**
     * Set volume
     *
     * @param int $volume
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
     * @return int $volume
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * Set tier
     *
     * @param int $tier
     * @return self
     */
    public function setTier($tier)
    {
        $this->tier = $tier;
        return $this;
    }

    /**
     * Get tier
     *
     * @return int $tier
     */
    public function getTier()
    {
        return $this->tier;
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

    public function deleteId()
    {
        unset($this->id);
        return $this;
    }
}
