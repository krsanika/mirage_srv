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
    protected $idEquipment;

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
    public function setIdEquipment($idEquipment)
    {
        $this->idEquipment = $idEquipment;
        return $this;
    }

    /**
     * Get equipmentId
     *
     * @return int $equipmentId
     */
    public function getIdEquipment()
    {
        return $this->idEquipment;
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

    public function deleteId()
    {
        unset($this->id);
        return $this;
    }
}
